<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} - {{ $company->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <x-button-link>
                    {{ __('Appointments waiting for approval') }}
                </x-button-link>
                <x-button-link>
                    {{ __('Employees') }}
                </x-button-link>
            </div>
        </div>
    </div>
</x-app-layout>
