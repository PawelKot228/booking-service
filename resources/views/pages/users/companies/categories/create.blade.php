<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }} - {{ __('Create category') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                <form action="{{ route('users.companies.categories.store', [$company]) }}"
                      method="POST"
                >
                    @csrf

                    <div class="flex flex-wrap">
                        <div class="w-full md:w-3/4 lg:w-1/2"
                             x-data="categorySelect()"
                        >
                            <div class="p-2">
                                <x-label for="category" value="{{ __('Category') }}"/>
                                <x-select id="category" name="category" type="text" class="mt-1 block w-full"
                                          autofocus required
                                          x-on:change="selectedCategory()"
                                >
{{--                                    <option selected>{{ __('Choose a category') }}</option>--}}

                                    @foreach(\App\Enums\ServiceCategory::cases() as $category)
                                        <option {{ $category->value == old('category') ? 'selected' : '' }}
                                                value="{{ $category->value }}"
                                        >
                                            {{ __($category->value) }}
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-input-error for="category" class="mt-2"/>
                            </div>
                            <div class="p-2">
                                <x-label for="subcategory" value="{{ __('Subcategory') }}"/>
                                <x-select id="subcategory" name="subcategory" type="text" class="mt-1 block w-full"
                                          autofocus required
                                          @change="selectedSubcategory()"
                                >
                                    {{--                                    <option selected>{{ __('Choose a subcategory') }}</option>--}}


                                    @foreach(\App\Enums\ServiceCategory::cases() as $category)
                                        <optgroup label="{{ __($category->value) }}"
                                                  data-category="{{ $category->value }}">

                                            @foreach(\App\Enums\ServiceCategory::getSubcategories($category) as $subcategory)
                                                <option
                                                    {{ $subcategory->value == old('subcategory') ? 'selected' : '' }}
                                                    value="{{ $subcategory->value }}"
                                                >
                                                    {{ __($subcategory->value) }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach

                                </x-select>
                                <x-input-error for="category" class="mt-2"/>
                            </div>
                            <div class="p-2">
                                <x-label for="name" value="{{ __('Name') }}"/>
                                <x-input id="name" name="name" type="text" class="mt-1 block w-full"
                                         value="{{ old('name') }}"
                                         autofocus
                                />
                                <x-input-error for="name" class="mt-2"/>
                            </div>
                            <div class="p-2">
                                <x-label for="description" value="{{ __('Description') }}"/>
                                <x-textarea id="description" name="description" type="text" class="mt-1 block w-full"

                                >
                                    {{ old('description') }}
                                </x-textarea>
                                <x-input-error for="description" class="mt-2"/>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    @push('js')
        <script>
            function categorySelect() {
                return {
                    category: null,
                    subcategory: null,
                    selectedCategory() {
                        const cat = document.getElementById('category')

                        this.category = cat.value;
console.log(this.category)
                        // const subcat = document.getElementById('subcategory')

                        this.updateSubcategory();

                    },
                    selectedSubcategory(select) {
                        console.log(select)
                    },
                    updateSubcategory() {
                        const subcat = document.getElementById('subcategory')

                        subcat.querySelectorAll(`optgroup`)
                            .forEach(optgroup => {
                                optgroup.style.display = optgroup.dataset.category === this.category ? 'block' : 'none';

                                let hasSubcat = optgroup.querySelectorAll(`option[value='${this.subcategory}']`).length

                                if (!hasSubcat) {
                                    this.subcategory = null;
                                }

                            })

                        subcat.querySelectorAll('option[selected]')
                            .forEach(option => {
                            option.selected = false;
                        })

                        let option = subcat.querySelectorAll(`option[value='${this.category}']`)

                        if(option) {
                            option.selected = true;
                        }
                    }
                }
            }
        </script>

    @endpush

</x-app-layout>
