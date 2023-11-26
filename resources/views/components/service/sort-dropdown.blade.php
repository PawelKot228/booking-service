<div class="">
{{--    <label for="sortBySelect" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Sort by:') }} </label>--}}
    <select id="sortBySelect"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            x-data="selectSortBy()"
            x-on:change="fireChange"
    >
        <option value="best" selected x-on:select="fireChange('best')">{{ __('Highest rated') }}</option>
        <option value="most_reviews" x-on:select="fireChange('most_reviews')">{{ __('Most popular') }}</option>
        <option value="distance" disabled x-on:select="fireChange('distance')">{{ __('Closest to you') }}</option>
    </select>
</div>

<script>
    function selectSortBy() {
        return {
            fireChange(event) {
                let store = Alpine.store('companySearchForm') ?? {};
                store.orderBy = event.srcElement.value;
                Alpine.store('companySearchForm', store);

                Livewire.emit('companyListRefresh', store)
            }
        }
    }
</script>
