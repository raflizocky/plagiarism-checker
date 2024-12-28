<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;
// use Barryvdh\DomPDF\Facade\Pdf;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortField = $request->query('sort', 'nip');
        $sortDirection = $request->query('direction', 'desc');
        $search = $request->query('search');
        $perPage = 5;

        $allowedSortFields = ['nip', 'position', 'name', 'email', 'role'];

        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'nip';
        }

        if ($sortField === 'nip') {
            $sortDirection = 'desc';
        }

        $query = User::when($search, function ($query, $search) {
            return $query->where('nip', 'like', '%' . $search . '%')
                ->orWhere('position', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('role', 'like', '%' . $search . '%');
        });

        $papers = $query->orderBy($sortField, $sortDirection)->paginate($perPage);

        return view('superadmin.index', [
            'paper' => $papers,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection,
            'search' => $search,
        ]);
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
                'nip' => 'required|unique:users,nip',
                'position' => 'required|unique:users,position|max:70',
                'name' => 'required|unique:users,name|max:70',
                'email' => 'required|unique:users,email|max:30',
                'password' => 'required|min:8|max:60',
                'role' => 'required|in:superadmin,admin',
            ], [
                'nip.unique' => 'This NIP is already registered.',
                'name.unique' => 'This Name is already registered.',
                'email.unique' => 'This Email is already registered.',
                'position.unique' => 'This Position is already registered.',
                'role.in' => 'The selected role is invalid.',
            ]);

            User::create($validatedData);

            return redirect()->route('superadmin.index')->with('success', 'Data Added Successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $userData = $user->toArray();
        $userData['password'] = ''; // placeholder
        return response()->json($userData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $validatedData = $request->validate([
                'nip' => 'required|unique:users,nip,' . $id,
                'position' => 'required|max:70|unique:users,position,' . $id,
                'name' => 'required|max:70|unique:users,name,' . $id,
                'email' => 'required|email|max:30|unique:users,email,' . $id,
                'role' => 'required|in:superadmin,admin',
            ]);

            if ($request->filled('password')) {
                $validatedData['password'] = bcrypt($request->password);
            } else {
                unset($validatedData['password']);
            }

            $user = User::findOrFail($id);
            $user->update($validatedData);

            return redirect()->route('superadmin.index')->with('success', 'Data Updated Successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function bulkDelete(Request $request)
    {
        try {
            $selectedItems = $request->input('selected');

            if (empty($selectedItems)) {
                $count = User::truncate();
                $message = 'All users have been deleted.';
            } else {
                $selectedIds = explode(',', $selectedItems);
                $count = User::whereIn('id', $selectedIds)->delete();
                $message = $count . ' user(s) deleted successfully.';
            }

            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting users: ' . $e->getMessage()], 500);
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
                'B' => 'email',
                'C' => 'name',
                'D' => 'role',
                'E' => 'position',
                'F' => 'nip'
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
                    User::create($paperData);
                    $importedCount++;
                    Log::info("Imported row " . $row->getRowIndex() . ": " . json_encode($paperData));
                } catch (\Exception $e) {
                    $skippedCount++;
                    Log::warning("Failed to import row " . $row->getRowIndex() . ": " . $e->getMessage());
                }
            }

            Log::info("Import process completed. Imported: $importedCount, Skipped: $skippedCount");

            return redirect()->route('superadmin.index')->with('success', "Data imported successfully! Imported: $importedCount, Skipped: $skippedCount");
        } catch (\Exception $e) {
            Log::error("Error during import process: " . $e->getMessage());
            return redirect()->route('superadmin.index')->with('error', 'Error processing file: ' . $e->getMessage());
        }
    }

    // public function exportPDF()
    // {
    //     try {
    //         $users = User::all();

    //         if ($users->isEmpty()) {
    //             throw new \Exception('No users found to export.');
    //         }

    //         $pdf = Pdf::loadView('superadmin.pdf', compact('users'));

    //         return $pdf->download('list-users-' . now()->format('Y-m-d') . '.pdf');
    //     } catch (\Exception $e) {
    //         Log::error('PDF export failed: ' . $e->getMessage());
    //         return back()->with('error', 'Failed to export PDF. Please try again.');
    //     }
    // }
}
