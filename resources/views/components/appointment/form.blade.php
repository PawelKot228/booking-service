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
                <x-label for="service_id" value="{{ __('Service') }}"/>
                <livewire:company.appointment.service-select companyId="{{ $company->id }}" />
                <x-input-error for="service_id" class="mt-2"/>
            </div>
            <div class="p-2">
                <x-label for="day" value="{{ __('Day') }}"/>
                <livewire:company.appointment.day-select companyId="{{ $company->id }}" />
                <x-input-error for="day" class="mt-2"/>
            </div>
            <div class="p-2">
                <x-label for="hour" value="{{ __('Hour') }}"/>
                <livewire:company.appointment.hour-select companyId="{{ $company->id }}" />
                <x-input-error for="hour" class="mt-2"/>
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


</form>

