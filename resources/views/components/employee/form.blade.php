@props([
    'action' => null,
    'update' => false,
    'company' => null,
    'user' => null,
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
                <x-label for="type" value="{{ __('Role') }}"/>
                <x-select id="type" name="type" type="text" class="mt-1 block w-full" autofocus required>
                    @foreach(\App\Enums\EmployeeRole::cases() as $role)
                        <option {{ in_array($role->value, [old('type'), $user?->role?->type]) ? 'selected' : '' }}
                                value="{{ $role->value }}"
                        >
                            {{ __($role->value) }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error for="type" class="mt-2"/>
            </div>
            <div class="p-2">
                <x-label for="email" value="{{ __('E-Mail') }}"/>
                <x-input id="email" name="email" type="text" class="mt-1 block w-full"
                         value="{{ old('email') ?? $user?->email }}"
                         autofocus
                />
                <x-input-error for="email" class="mt-2"/>
            </div>
        </div>
    </div>

    <div class="text-right p-2">
        <x-button>
            {{ __('Save') }}
        </x-button>
        <x-button-link href="{{ route('users.companies.employees.index', [$company]) }}">
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
