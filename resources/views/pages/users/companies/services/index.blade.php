<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }} - {{ $companyCategory->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <x-leading-text-header>
                    {{ __('Services') }}
                </x-leading-text-header>

                <div class="text-right mb-2">
                    <x-button-link
                        href="{{ route('users.companies.categories.services.create', [$company, $companyCategory]) }}"
                    >
                        {{ __('Add Service') }}
                    </x-button-link>
                </div>
                <livewire:company-service-table
                    companyId="{{ $company->id }}"
                    companyCategoryId="{{ $companyCategory->id }}"
                />
            </div>
        </div>
    </div>
</x-app-layout>
