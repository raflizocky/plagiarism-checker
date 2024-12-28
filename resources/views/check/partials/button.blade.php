{{-- Buttons --}}
<div
    class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
    {{-- Search --}}
    <form method="GET" action="{{ route('check.index') }}">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" name="search" id="table-search-users" value="{{ request()->get('search') }}"
                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search...">
        </div>
    </form>

    <div>
        {{-- Import --}}
        <button type="button" data-modal-target="import-modal" data-modal-toggle="import-modal"
            class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-gray-400 dark:hover:bg-gray-500 dark:focus:ring-gray-700"
            data-tooltip-target="tooltip-import" data-tooltip-placement="top">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 16v-6m0 0l-3 3m3-3l3 3M5 19h14M3 9h18" />
            </svg>
            <span class="sr-only">Import</span>
        </button>
        <div id="tooltip-import" role="tooltip"
            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Import
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        {{-- Delete --}}
        <button id="delete-button" type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal"
            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800"
            data-tooltip-target="tooltip-delete" data-tooltip-placement="top">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-1 12H6L5 7m5 4v6m4-6v6M9 7h6m2-2H7m3-1h4" />
            </svg>
            <span class="sr-only">Delete</span>
        </button>
        <div id="tooltip-delete" role="tooltip"
            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Delete
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        {{-- Edit --}}
        <button type="button" id="edit-button" data-modal-target="edit-modal" data-modal-toggle="edit-modal"
            class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-700"
            data-tooltip-target="tooltip-edit" data-tooltip-placement="top">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536M9 13.5l3.536-3.536 3.536-3.536M9 13.5V18H4v-5.5h5.5z" />
            </svg>
            <span class="sr-only">Edit</span>
        </button>
        <div id="tooltip-edit" role="tooltip"
            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Edit
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        {{-- Add --}}
        <button type="button" data-modal-target="add-modal" data-modal-toggle="add-modal"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            data-tooltip-target="tooltip-add" data-tooltip-placement="top">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="sr-only">Add</span>
        </button>
        <div id="tooltip-add" role="tooltip"
            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Add
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
</div>
