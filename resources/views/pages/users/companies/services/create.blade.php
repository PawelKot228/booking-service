<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }} - {{ __('Create service') }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($companyCategory, $company) }}

    <x-page-body>
        <x-leading-text-header>
            {{ __('Create') }}
        </x-leading-text-header>

        <x-service.form :action="route('users.companies.categories.services.store', [$company, $companyCategory])"
                        :company="$company" :company-category="$companyCategory"
        />
    </x-page-body>

</x-app-layout>
