<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }} - {{ __('Edit category') }}: {{ $companyCategory->name }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($companyCategory, $company) }}

    <x-page-body>
        <x-leading-text-header>
            {{ __('Edit') }}
        </x-leading-text-header>

        <x-category.form :action="route('users.companies.categories.update', [$company, $companyCategory])"
                         :company="$company" :companyCategory="$companyCategory"
                         :update="true"
        />
    </x-page-body>
</x-app-layout>
