<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create company') }}
        </h2>
    </x-slot>

    <x-page-body>
        <x-leading-text-header>
            {{ __('Write a review') }}

            <x-slot:buttons>
                <x-button>
                    {{ __('Save') }}
                </x-button>
            </x-slot:buttons>
        </x-leading-text-header>

        <x-review.form url="{{ route('users.appointments.reviews.store', [$appointment]) }}"/>

    </x-page-body>

</x-app-layout>
