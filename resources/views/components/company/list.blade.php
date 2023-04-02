<div id="companyList"
     class="py-5 px-2"
     x-cloak
     x-data="companyList()"
     x-init="fetchCompanies()"
>
    <h1 x-show="isLoading">{{ __('Lading...') }}</h1>

    <div class="flex flex-col gap-3"
         x-show="!isLoading"
    >
        <template x-for="company in companies" :key="company.id">
            <div class="flex gap-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <span class="font-medium text-gray-600 dark:text-gray-300">JL</span>
                    </div>
                </div>

                <div>
                    <a :href="company.url">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                            x-text="company.name"
                        >
                        </h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                       x-text="company.description"
                    >
                    </p>
                    <a :href="company.url"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Read more
                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>

            </div>
        </template>
    </div>
</div>

@push('js')
    <script>
        function companyList() {
            return {
                isLoading: true,
                companies: {},
                fetchCompanies() {
                    this.isLoading = true;

                    fetch("{{ route('api.companies.list') }}")
                        .then(res => res.json())
                        .then(data => {
                            this.companies = data.data
                            this.isLoading = false;
                        })
                }
            }
        }

    </script>
@endpush