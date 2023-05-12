<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <x-page-body>
        <x-leading-text-header>
            {{ __('Create company') }}

            <x-slot:buttons>
                <x-button>
                    {{ __('Create') }}
                </x-button>
            </x-slot:buttons>
        </x-leading-text-header>


    </x-page-body>

</x-app-layout>
