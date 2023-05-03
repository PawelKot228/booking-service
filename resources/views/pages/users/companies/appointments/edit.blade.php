<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($appointment, $company) }}

    <x-page-body>
        <x-leading-text-header>
            {{ __('Edit') }}
        </x-leading-text-header>

        <x-category.form :action="route('users.companies.appointments.update', [$company, $appointment])"
                         :company="$company" :appointment="$appointment"
                         :update="true"
        />
    </x-page-body>
</x-app-layout>
