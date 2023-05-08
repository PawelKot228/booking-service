<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }} - {{ $companyCategory->name }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($companyCategory, $company) }}

    <x-page-body>
        <x-leading-text-header>
            {{ __('Services') }}

            @if(auth()->user()->isManager())
                <x-slot name="buttons">
                    <x-button-link
                        href="{{ route('users.companies.categories.services.create', [$company, $companyCategory]) }}">
                        {{ __('Add Service') }}
                    </x-button-link>
                </x-slot>
            @endif
        </x-leading-text-header>

        <livewire:data-table.company-service-table
            companyId="{{ $company->id }}"
            companyCategoryId="{{ $companyCategory->id }}"
        />
    </x-page-body>

</x-app-layout>
