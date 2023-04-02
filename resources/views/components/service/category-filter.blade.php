<div>

    <x-button id="dropdownDefault" data-dropdown-toggle="dropdown" class="w-full">
        <span>
            {{ __('Choose categories') }}
        </span>

        <svg class="w-4 h-4 ml-2 inline" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </x-button>


    <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
        @foreach(\App\Enums\ServiceCategory::cases() as $category)
            <div id="filter_{{$category->value}}" x-data="selectCategoriesFilter('{{ $category->value }}')">
                <h6 class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    <input id="{{ $category->value }}" type="checkbox" value=""
                           x-model="selected"
                           x-on:click="checkAll()"
                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                    />

                    <label {{--for="{{ $category->value }}"--}}
                           class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100"
                           x-on:click="open = !open"
                    >
                        {{ __($category->value) }}
                    </label>

                    <button x-on:click="open = !open">
                        <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </h6>

                <ul class="space-y-2 text-sm pl-4 {{ !$loop->last ? 'mb-3' : '' }}"
                    x-show="open" x-transition
                    aria-labelledby="dropdownDefault"
                >
                    @foreach(\App\Enums\ServiceCategory::getSubcategories($category) as $subcategory)
                        <li class="flex items-center">
                            <input class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                   id="subcategory_{{ $subcategory->value }}"
                                   data-type="categorySubFilter"
                                   data-name="{{ $subcategory->value }}"
                                   type="checkbox" value=""
                                   x-model="checkboxes.{{ $subcategory->value }}"
                                   x-on:click="unselectSubcategory('{{ $subcategory->value }}')"
                            />

                            <label for="subcategory_{{ $subcategory->value }}"
                                   class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ __($subcategory->value) }}
                            </label>


                        </li>
                    @endforeach

                </ul>
            </div>

        @endforeach


    </div>
</div>

@push('js')
    <script>
        const selectedCategory = "{{ request('categoryName') }}";

        function selectCategoriesFilter(category) {
            return {
                open: false,
                selected: false,
                checkboxes: {},
                checkAll() {
                    Object.keys(this.checkboxes)
                        .forEach(name => {
                            this.checkboxes[name] = !this.selected;
                        });

                    this.selected = !this.selected;
                },
                unselectSubcategory(checkboxName) {
                    const checkbox = document.querySelector(`input[data-name='${checkboxName}']`);
                    this.checkboxes[checkboxName] = checkbox.checked;

                    let allSelected = true;
                    Object.values(this.checkboxes)
                        .forEach(checked => {
                            if (!checked) {
                                allSelected = false;
                            }
                        });

                    this.selected = allSelected;
                },
                init() {
                    const check = selectedCategory === category;
                    const filterCategoryId = `filter_${category}`;

                    this.selected = check;
                    document.querySelectorAll(`#${filterCategoryId} input[data-type='categorySubFilter']`)
                        .forEach(el => {
                            this.checkboxes[el.dataset.name] = check
                        })
                }
            }
        }
    </script>
@endpush