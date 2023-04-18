<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create company') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                <form action="{{ route('companies.store') }}" method="POST">
                    @csrf

                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 lg:w-1/3 space-y-4">
                            <div class="p-2">
                                <x-label for="name" value="{{ __('Name') }}" />
                                <x-input id="name" name="name" type="text" class="mt-1 block w-full" autofocus />
                                <x-input-error for="name" class="mt-2" />
                            </div>
                            <div class="p-2">
                                <x-label for="description" value="{{ __('Description') }}" />
                                <x-textarea id="description" name="description" type="text" class="mt-1 block w-full" />
                                <x-input-error for="description" class="mt-2" />
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 lg:w-2/3">
                            <div class="flex flex-wrap">
                                <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 p-2">
                                    <x-label for="street_name" value="{{ __('Street name') }}" />
                                    <x-input id="street_name" name="street_name" type="text" class="mt-1 block w-full" />
                                    <x-input-error for="street_name" class="mt-2" />
                                </div>
                                <div class="w-1/2 sm:w-1/4 md:w-1/2 lg:w-1/4 p-2">
                                    <x-label for="street_number" value="{{ __('Street number') }}" />
                                    <x-input id="street_number" name="street_number" type="text" class="mt-1 block w-full" />
                                    <x-input-error for="street_number" class="mt-2" />
                                </div>
                                <div class="w-1/2 sm:w-1/4 md:w-1/2 lg:w-1/4 p-2">
                                    <x-label for="apartment_number" value="{{ __('Apartment number') }}" />
                                    <x-input id="apartment_number" name="apartment_number" type="text" class="mt-1 block w-full" />
                                    <x-input-error for="apartment_number" class="mt-2" />
                                </div>
                                <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 p-2">
                                    <x-label for="zip_code" value="{{ __('Zip code') }}" />
                                    <x-input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full" />
                                    <x-input-error for="zip_code" class="mt-2" />
                                </div>
                                <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 p-2">
                                    <x-label for="city" value="{{ __('City') }}" />
                                    <x-input id="city" name="city" type="text" class="mt-1 block w-full" />
                                    <x-input-error for="city" class="mt-2" />
                                </div>
                                <div class="w-1/2 md:w-full lg:w-1/2 p-2">
                                    <x-label for="latitude" value="{{ __('Latitude') }}" />
                                    <x-input id="latitude" name="latitude" type="text" class="mt-1 block w-full" />
                                    <x-input-error for="latitude" class="mt-2" />
                                </div>
                                <div class="w-1/2 md:w-full lg:w-1/2 p-2">
                                    <x-label for="longitude" value="{{ __('Longitude ') }}" />
                                    <x-input id="longitude" name="longitude" type="text" class="mt-1 block w-full" />
                                    <x-input-error for="longitude" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-3">
                        <x-button>
                            {{ __('Create') }}
                        </x-button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
