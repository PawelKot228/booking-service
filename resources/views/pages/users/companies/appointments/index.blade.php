<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($company) }}

    <x-page-body>
        <x-leading-text-header>
            {{ __('Appointments') }}

            @if(auth()->user()->isManager($company))
                <x-slot name="buttons">
                    <x-button-link href="{{ route('users.companies.appointments.create', [$company]) }}">
                        {{ __('Add Appointment') }}
                    </x-button-link>
                </x-slot>
            @endif
        </x-leading-text-header>

        <livewire:data-table.company-appointment-table companyId="{{ $company->id }}" />
    </x-page-body>
</x-app-layout>
