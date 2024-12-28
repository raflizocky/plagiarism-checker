 {{-- Table --}}
 <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
     <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
         <tr>
             {{-- Checkbox --}}
             <th scope="col" class="p-4">
                 <div class="flex items-center">
                     <input id="checkbox-all-search" type="checkbox"
                         class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                     <label for="checkbox-all-search" class="sr-only">checkbox</label>
                 </div>
             </th>
             <th scope="col" class="px-6 py-3">
                 <div class="flex items-center">
                     Title
                     <a
                         href="?sort=title&direction={{ $sortField === 'title' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                         <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 24 24">
                             <path
                                 d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                         </svg>
                     </a>
                 </div>
             </th>
             <th scope="col" class="px-6 py-3">
                 <div class="flex items-center">
                     Year
                     <a
                         href="?sort=year&direction={{ $sortField === 'year' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                         <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 24 24">
                             <path
                                 d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                         </svg>
                     </a>
                 </div>
             </th>
             <th scope="col" class="px-6 py-3">
                 <div class="flex items-center">
                     NIM
                     <a
                         href="?sort=nim&direction={{ $sortField === 'nim' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                         <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 24 24">
                             <path
                                 d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                         </svg>
                     </a>
                 </div>
             </th>
             <th scope="col" class="px-6 py-3">
                 <div class="flex items-center">
                     Author
                     <a
                         href="?sort=author&direction={{ $sortField === 'author' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                         <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 24 24">
                             <path
                                 d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                         </svg>
                     </a>
                 </div>
             </th>
             <th scope="col" class="px-6 py-3">
                 <div class="flex items-center">
                     Mentor
                     <a
                         href="?sort=mentor&direction={{ $sortField === 'mentor' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                         <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 24 24">
                             <path
                                 d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                         </svg>
                     </a>
                 </div>
             </th>
             @if ($showSimilarity)
                 <th scope="col" class="px-6 py-3">
                     Similarity
                 </th>
             @endif
         </tr>
     </thead>
     <tbody>
         @if ($paper->isEmpty())
             <tr class="bg-white dark:bg-gray-800">
                 <td colspan="{{ $showSimilarity ? 7 : 6 }}"
                     class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                     No scientific papers found.
                 </td>
             </tr>
         @else
             @foreach ($paper as $row)
                 <tr
                     class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                     <td class="w-4 p-4">
                         <div class="flex items-center">
                             <input id="checkbox-table-search-{{ $row->id }}" type="checkbox" name="selected[]"
                                 value="{{ $row->id }}"
                                 class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                             <label for="checkbox-table-search{{ $row->id }}" class="sr-only">checkbox</label>
                         </div>
                     </td>
                     <td class="px-6 py-4">{{ $row->title }}</td>
                     <td class="px-6 py-4">{{ $row->year }}</td>
                     <td class="px-6 py-4">{{ $row->nim }}</td>
                     <td class="px-6 py-4">{{ $row->author }}</td>
                     <td class="px-6 py-4">{{ $row->mentor }}</td>
                     @if ($showSimilarity)
                         <td class="px-6 py-4">
                             {{ number_format($row->similarity * 100, 2) }}%
                         </td>
                     @endif
                 </tr>
             @endforeach
         @endif
     </tbody>
 </table>
