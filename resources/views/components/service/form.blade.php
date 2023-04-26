@props([
    'action' => null,
    'update' => false,
    'company' => null,
    'companyCategory' => null,
    'service' => null,
])

<form action="{{ $action }}"
    {!!  $attributes->merge(['method' => 'POST'])  !!}
>
    @csrf
    @if($update)
        @method('PUT')
    @endif

    <div class="flex flex-wrap">
        <div class="w-full md:w-3/4 lg:w-1/2">
            <div class="p-2">
                <x-label for="name" value="{{ __('Name') }}"/>
                <x-input id="name" name="name" type="text" class="mt-1 block w-full"
                         value="{{ old('name') ?? $service?->name }}"
                         autofocus
                />
                <x-input-error for="name" class="mt-2"/>
            </div>
            <div class="p-2">
                <x-label for="description" value="{{ __('Description') }}"/>
                <x-textarea id="description" name="description" type="text" class="mt-1 block w-full"
                            :old="'description'"
                >
                    {{ $service?->description }}
                </x-textarea>
                <x-input-error for="description" class="mt-2"/>
            </div>

            <div class="p-2">
                <x-label for="duration" value="{{ __('Duration in minutes') }}"/>
                <x-input id="duration" name="duration" type="text" class="mt-1 block w-full"
                         type="number" value="{{ old('duration') ?? $service?->duration }}"
                />
                <x-input-error for="duration" class="mt-2"/>
            </div>

            <div class="p-2">
                <x-label for="price" value="{{ __('Price') }}"/>
                <x-input id="price" name="price" type="text" class="mt-1 block w-full"
                         type="number" value="{{ old('price') ?? $service?->price }}"
                />
                <x-input-error for="price" class="mt-2"/>
            </div>

            <div class="p-2">
                <x-label for="currency" value="{{ __('Currency') }}"/>
                <x-select id="currency" name="currency" type="text" class="mt-1 block w-full">
                    @foreach(\App\Enums\Currency::cases() as $currency)
                        <option {{ in_array($currency->value, [old('currency'), $service?->currency]) ? 'selected' : '' }}
                                value="{{ $currency->value }}"
                        >
                            {{ __($currency->value) }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error for="currency" class="mt-2"/>
            </div>

        </div>
    </div>

    <div class="text-right p-2">
        <x-button>
            {{ __('Save') }}
        </x-button>
        <x-button-link href="{{ route('users.companies.categories.services.index', [$company, $companyCategory]) }}">
            {{ __('Exit') }}
        </x-button-link>
    </div>

</form>
