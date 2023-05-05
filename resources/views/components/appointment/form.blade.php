@props([
    'action' => null,
    'appointment' => null,
    'company' => null,
])

<form action="{{ $action }}"
    {!!  $attributes->merge(['method' => 'POST'])  !!}
>
    @csrf

    <div class="flex flex-wrap">
        <div class="w-full md:w-3/4 lg:w-1/2">
            <livewire:appointment.schedule-selects
                companyId="{{ $company->id }}"
            />

            <div class="p-2">
                <x-label for="employee_id" value="{{ __('Employee') }}"/>
                <livewire:select.company-employees companyId="{{ $company->id }}" />
                <x-input-error for="employee_id" class="mt-2"/>
            </div>

            <div class="p-2">
                <x-label for="user_id" value="{{ __('User Email') }}"/>
                <x-input id="user_id" name="user_id" type="text" class="mt-1 block w-full"
                         value="{{ old('user_id') }}"
                />
                <x-input-error for="user_id" class="mt-2"/>
            </div>

{{--            <div class="p-2">--}}
{{--                <x-label for="name" value="{{ __('Name') }}"/>--}}
{{--                <x-input id="name" name="name" type="text" class="mt-1 block w-full"--}}
{{--                         value="{{ old('name') ?? $companyCategory?->name }}"--}}
{{--                />--}}
{{--                <x-input-error for="name" class="mt-2"/>--}}
{{--            </div>--}}
{{--            <div class="p-2">--}}
{{--                <x-label for="description" value="{{ __('Description') }}"/>--}}
{{--                <x-textarea id="description" name="description" type="text" class="mt-1 block w-full"--}}
{{--                            :old="'description'"--}}
{{--                >--}}
{{--                    {{ $companyCategory?->description }}--}}
{{--                </x-textarea>--}}
{{--                <x-input-error for="description" class="mt-2"/>--}}
{{--            </div>--}}
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

