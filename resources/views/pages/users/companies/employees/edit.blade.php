<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }} - {{ __('Edit employee') }}: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <x-leading-text-header>
                    {{ __('Edit') }}
                </x-leading-text-header>

                <x-employee.form :action="route('users.companies.employees.update', [$company, $user])"
                                 :company="$company" :user="$user"
                                 :update="true"
                />
            </div>
        </div>
    </div>

</x-app-layout>
