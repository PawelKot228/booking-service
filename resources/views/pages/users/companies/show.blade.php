<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} - {{ $company->name }}
        </h2>
    </x-slot>

    <x-page-body>
        <x-button-link href="{{ route('users.companies.employees.index', [$company]) }}">
            {{ __('Show list of employees') }}
        </x-button-link>
        <x-button-link href="{{ route('users.companies.appointments.index', [$company]) }}">
            {{ __('Appointments waiting for approval') }}
        </x-button-link>
        <x-button-link href="{{ route('users.companies.categories.index', [$company]) }}">
            {{ __('Categories & services') }}
        </x-button-link>
    </x-page-body>

</x-app-layout>
