<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($company) }}

    <x-page-body>
        <x-leading-text-header>
            {{ __('Categories') }}

            <x-slot name="buttons">
                <x-button-link href="{{ route('users.companies.categories.create', [$company]) }}">
                    {{ __('Add Category') }}
                </x-button-link>
            </x-slot>
        </x-leading-text-header>

        <livewire:data-table.company-category-table companyId="{{ $company->id }}"/>
    </x-page-body>
</x-app-layout>
