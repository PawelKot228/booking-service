<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }} - {{ $service->name }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($service, $companyCategory, $company) }}

    <x-page-body>
        <x-leading-text-header>
            {{ __('Edit') }}
        </x-leading-text-header>

        <x-service.form
            :action="route('users.companies.categories.services.update', [$company, $companyCategory, $service])"
            :company="$company" :company-category="$companyCategory" :service="$service"
            :update="true"
        />
    </x-page-body>

</x-app-layout>
