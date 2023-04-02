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
        <template x-if="Object.keys(companies).length === 0"
                  x-for="company in companies" :key="company.id"
        >
            <x-company.card/>
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