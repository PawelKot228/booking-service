<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <x-page-body>
        <x-simple-card>
            <x-slot:header>
                <h1 class="font-bold text-2xl">
                    Welcome to {{ config('app.name') }} – Your Premier Booking Companion!
                </h1>
            </x-slot:header>

            <p class="text-gray-500 dark:text-gray-400 mb-3">
                Discover a universe of convenience as you explore a curated selection of destinations, events, and services. From exclusive getaways to coveted events, exquisite dining to personalized adventures, our mission is to make booking an effortless journey toward unforgettable memories.
            </p>

            <p class="text-gray-500 dark:text-gray-400">
                Join us in unlocking the door to unparalleled convenience and tailored experiences.
                Let’s embark together on a journey where every reservation is not just a booking, but a chapter in your story of remarkable moments.
            </p>
        </x-simple-card>

        <div class="my-10"></div>

        <x-simple-card>
            <x-slot:header>
                <h2 class="font-bold text-2xl">
                    {{ __('Featured businesses') }}
                </h2>
            </x-slot:header>

            <livewire:company.featured-list />


            <x-button-link class="mt-4 w-full text-center" href="{{ route('services.search') }}">
                {{ __('See all') }}
            </x-button-link>
        </x-simple-card>

    </x-page-body>
</x-app-layout>
