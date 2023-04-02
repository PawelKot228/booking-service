<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Look up Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"
             x-data="window.searchCompanyForm"
        >
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-wrap lg:flex-nowrap gap-y-2 items-center p-2">
                    <div class="w-full sm:w-1/2 px-2">
                        <label for="search-place-input" class="sr-only">{{ __('Search') }}</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                     fill="currentColor"
                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                          clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </div>
                            <input type="text" id="search-place-input"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Search" required>
                        </div>
                    </div>

                    <div class="w-full sm:w-1/2 lg:w-1/4 px-2">
                        <x-service.category-filter/>
                    </div>

                    <div class="w-full lg:w-1/4 px-2">
                        <x-button class="w-full" id="searchCompanyButton">
                            {{ __('Apply') }}
                        </x-button>

                    </div>

                </div>

                <hr>

                <x-company.list/>

            </div>
        </div>
    </div>
</x-app-layout>


