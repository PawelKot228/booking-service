<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }} - {{ __('List of Employees') }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($company) }}

    <x-page-body>
        <div class="text-right mb-2">
            <x-button-link href="{{ route('users.companies.employees.create', [$company]) }}">
                {{ __('Add Employee') }}
            </x-button-link>
        </div>

        <livewire:company-employee-table companyId="{{ $company->id }}"/>
    </x-page-body>

</x-app-layout>
