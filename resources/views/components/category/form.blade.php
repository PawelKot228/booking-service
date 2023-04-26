@props([
    'action' => null,
    'update' => false,
    'company' => null,
    'companyCategory' => null,
])

<form action="{{ $action }}"
    {!!  $attributes->merge(['method' => 'POST'])  !!}
>
    @csrf
    @if($update)
        @method('PUT')
    @endif

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
                        <option {{ in_array($category->value, [old('category'), $companyCategory?->category]) ? 'selected' : '' }}
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
                                    {{ in_array($subcategory->value, [old('subcategory'), $companyCategory?->subcategory]) ? 'selected' : '' }}
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
                         value="{{ old('name') ?? $companyCategory?->name }}"
                         autofocus
                />
                <x-input-error for="name" class="mt-2"/>
            </div>
            <div class="p-2">
                <x-label for="description" value="{{ __('Description') }}"/>
                <x-textarea id="description" name="description" type="text" class="mt-1 block w-full"
                            :old="'description'"
                >
                    {{ $companyCategory?->description }}
                </x-textarea>
                <x-input-error for="description" class="mt-2"/>
            </div>
        </div>
    </div>

    <div class="text-right p-2">
        <x-button>
            {{ __('Save') }}
        </x-button>
        <x-button-link href="{{ route('users.companies.categories.index', [$company]) }}">
            {{ __('Exit') }}
        </x-button-link>
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

                        if (option) {
                            option.selected = true;
                        }
                    }
                }
            }
        </script>

    @endpush


</form>
