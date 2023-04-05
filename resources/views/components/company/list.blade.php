<div id="companyList"
     class="py-5 px-2"
     x-cloak
     x-data="companyList()"

     @foo.window="Alpine.eve"
>
    <h1 x-show="isLoading">{{ __('Lading...') }}</h1>

    <div class="flex flex-col gap-3"
         x-show="!isLoading"
    >
        <template x-for="company in companies" :key="company.id">
            <div class="flex gap-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center text-center">

                    <div>
                        <div class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <span class="font-medium text-gray-600 dark:text-gray-300">JL</span>
                        </div>

                        <div class="flex items-center justify-center mt-2">
                            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>{{ __('Rating star') }}</title>
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <p class="text-sm font-bold text-gray-900 dark:text-white"
                                x-text="company.appointments_avg_rating"
                            ></p>
                        </div>

                        <a href="#" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white">73 reviews</a>

                    </div>
                </div>

                <div>
                    <a x-bind:href="company.url">
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                            x-text="company.name"
                        >
                        </h5>
                    </a>
                    <p>
                        <template x-for="category in company.tags.categories">
                            <span class="bg-pink-100 text-pink-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300"
                                  x-text="category"
                            >
                            </span>
                        </template>
                    </p>
                    <p class="mb-2">
                        <template x-for="subcategory in company.tags.subcategories">
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300"
                                  x-text="subcategory"
                            >
                            </span>
                        </template>
                    </p>

                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                       x-text="company.description"
                    >
                    </p>

                    <a class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                       x-bind:href="company.url"
                    >
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
                    const url = new URL("{{ route('api.companies.list') }}");

                    const attributes = Alpine.store('companySearchForm');

                    url.searchParams.set('categoryNames', btoa(JSON.stringify(attributes?.categories ?? [])));
                    url.searchParams.set('subcategoryNames', btoa(JSON.stringify(attributes?.subcategories ?? [])));
                    url.searchParams.set('lat', attributes?.lat ?? null);
                    url.searchParams.set('lng', attributes?.lng ?? null);
                    url.searchParams.set('place_id', attributes?.place_id ?? null);

                    fetch(url.toString())
                        .then(res => res.json())
                        .then(data => {
                            this.companies = data.data
                            this.isLoading = false;
                        })
                },
                init() {
                    window.addEventListener('company-list-refresh', () => {
                        this.fetchCompanies();
                    })

                    this.fetchCompanies()
                },
            }
        }

    </script>
@endpush