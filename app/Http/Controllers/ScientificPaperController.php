<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scientific_Paper;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;

class ScientificPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortField = $request->query('sort', 'year');
        $sortDirection = $request->query('direction', 'desc');
        $search = $request->query('search');
        $page = $request->query('page', 1);
        $perPage = 5;

        $allowedSortFields = ['title', 'year', 'nim', 'author', 'mentor'];

        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'year';
        }

        if ($sortField === 'year') {
            $sortDirection = 'desc';
        }

        $query = Scientific_Paper::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('year', 'like', '%' . $search . '%')
                ->orWhere('nim', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('mentor', 'like', '%' . $search . '%');
        });

        $showSimilarity = false;
        if ($search) {
            $showSimilarity = true;
            $allPapers = $query->get();

            foreach ($allPapers as $paper) {
                $paper->similarity = $this->jaccardSimilarity($search, $paper->title);
            }

            $sortedPapers = $allPapers->sortByDesc('similarity')->values();

            // Manual pagination
            $total = $sortedPapers->count();
            $papers = new \Illuminate\Pagination\LengthAwarePaginator(
                $sortedPapers->forPage($page, $perPage),
                $total,
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        } else {
            $papers = $query->orderBy($sortField, $sortDirection)->paginate($perPage);
        }

        return view('check.index', [
            'paper' => $papers,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection,
            'search' => $search,
            'showSimilarity' => $showSimilarity
        ]);
    }

    private function jaccardSimilarity($str1, $str2)
    {
        $str1 = strtolower($str1);
        $str2 = strtolower($str2);
        $set1 = array_unique(explode(' ', $str1));
        $set2 = array_unique(explode(' ', $str2));

        $intersection = count(array_intersect($set1, $set2));
        $union = count(array_unique(array_merge($set1, $set2)));

        return $union > 0 ? $intersection / $union : 0;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|unique:scientific_papers,title',
                'year' => 'required|numeric|digits:4',
                'nim' => 'required|unique:scientific_papers,nim|max:10',
                'author' => 'required|unique:scientific_papers,author|max:30',
                'mentor' => 'required|max:70',
            ], [
                'title.unique' => 'This title is already registered.',
                'nim.unique' => 'This NIM is already registered.',
                'author.unique' => 'This author is already registered.',
                'year.digits' => 'The year must be exactly 4 digits.',
                'year.numeric' => 'The year must be a number.',
            ]);

            Scientific_Paper::create($validatedData);

            return redirect()->route('check.index')->with('success', 'Data Added Successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Scientific_Paper $scientific_Paper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paper = Scientific_Paper::findOrFail($id);
        return response()->json($paper);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|unique:scientific_papers,title,' . $id,
                'year' => 'required|numeric|digits:4',
                'nim' => 'required|unique:scientific_papers,nim,' . $id . '|max:10',
                'author' => 'required|unique:scientific_papers,author,' . $id . '|max:30',
                'mentor' => 'required|max:70',
            ], [
                'title.unique' => 'This title is already registered.',
                'nim.unique' => 'This NIM is already registered.',
                'author.unique' => 'This author is already registered.',
                'year.digits' => 'The year must be exactly 4 digits.',
                'year.numeric' => 'The year must be a number.',
            ]);

            $paper = Scientific_Paper::findOrFail($id);
            $paper->update($validatedData);

            return redirect()->route('check.index')->with('success', 'Data Updated Successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scientific_Paper $scientific_Paper)
    {
        //
    }

    public function bulkDelete(Request $request)
    {
        try {
            $selectedItems = $request->input('selected');

            if (empty($selectedItems)) {
                $count = Scientific_Paper::truncate();
                $message = 'All scientific papers have been deleted.';
            } else {
                $selectedIds = explode(',', $selectedItems);
                $count = Scientific_Paper::whereIn('id', $selectedIds)->delete();
                $message = $count . ' scientific paper(s) deleted successfully.';
            }

            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting papers: ' . $e->getMessage()], 500);
        }
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx,csv'
            ]);

            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();

            $startRow = 2; // Assuming the first row is headers
            $totalRows = $worksheet->getHighestRow();

            Log::info("Starting import process. Total rows in file: " . ($totalRows - 1));

            $columns = [
                'B' => 'author',
                'C' => 'nim',
                'D' => 'mentor',
                'E' => 'year',
                'F' => 'title'
            ];

            $importedCount = 0;
            $skippedCount = 0;

            // Iterate through each row in the worksheet
            foreach ($worksheet->getRowIterator($startRow) as $row) {
                $paperData = [];

                // Extract data from each relevant column
                foreach ($columns as $col => $field) {
                    $cell = $worksheet->getCell($col . $row->getRowIndex());
                    $paperData[$field] = $cell->getCalculatedValue();
                }

                try {
                    Scientific_Paper::create($paperData);
                    $importedCount++;
                    Log::info("Imported row " . $row->getRowIndex() . ": " . json_encode($paperData));
                } catch (\Exception $e) {
                    $skippedCount++;
                    Log::warning("Failed to import row " . $row->getRowIndex() . ": " . $e->getMessage());
                }
            }

            Log::info("Import process completed. Imported: $importedCount, Skipped: $skippedCount");

            return redirect()->route('check.index')->with('success', "Data imported successfully! Imported: $importedCount, Skipped: $skippedCount");
        } catch (\Exception $e) {
            Log::error("Error during import process: " . $e->getMessage());
            return redirect()->route('check.index')->with('error', 'Error processing file: ' . $e->getMessage());
        }
    }
}
