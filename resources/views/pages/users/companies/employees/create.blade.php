<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }} - {{ __('Create category') }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($company) }}

    <x-page-body>
        <x-leading-text-header>
            {{ __('Create') }}
        </x-leading-text-header>

        <x-employee.form :action="route('users.companies.employees.store', [$company])"
                         :company="$company"
        />
    </x-page-body>

</x-app-layout>
