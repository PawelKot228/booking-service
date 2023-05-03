<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }} - {{ __('Edit employee') }}: {{ $user->name }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($user, $company) }}

    <x-page-body>
        <x-leading-text-header>
            {{ __('Edit') }}
        </x-leading-text-header>

        <x-employee.form :action="route('users.companies.employees.update', [$company, $user])"
                         :company="$company" :user="$user"
                         :update="true"
        />
    </x-page-body>

</x-app-layout>
