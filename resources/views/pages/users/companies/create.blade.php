<x-app-layout>
    {{--    @dump($errors)--}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create company') }}
        </h2>
    </x-slot>

    <x-page-body>
        <form action="{{ route('users.companies.store') }}" method="POST">
            @csrf


            <div class="p-3 text-right">
                <x-button>
                    {{ __('Create') }}
                </x-button>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/2  space-y-4">
                    <div class="p-2">
                        <x-label for="name" value="{{ __('Name') }}"/>
                        <x-input id="name" name="name" type="text" class="mt-1 block w-full"
                                 value="{{ old('name') }}"
                                 autofocus
                        />
                        <x-input-error for="name" class="mt-2"/>
                    </div>
                    <div class="p-2">
                        <x-label for="description" value="{{ __('Description') }}"/>
                        <x-textarea id="description" name="description" type="text" class="mt-1 block w-full"

                        >
                            {{ old('description') }}
                        </x-textarea>
                        <x-input-error for="description" class="mt-2"/>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold">{{ __('Open Hours') }}</h3>
                        @foreach(\App\Enums\Day::cases() as $day)
                            <h6 class="text-sm font-semibold">{{ __($day->value) }}</h6>
                            <div class="flex flex-wrap">
                                <div class="w-1/2">
                                    <div class="p-2">
                                        <x-label for="open_hours_{{ $day->value }}_open" value="{{ __('Open') }}"/>
                                        <x-input id="open_hours_{{ $day->value }}_open"
                                                 name="open_hours[{{ $day->value }}][open]"
                                                 type="time" class="mt-1 block w-full"
                                                 value='{{ old("open_hours.$day->value.open") }}'
                                        />
                                        <x-input-error for="open_hours.{{ $day->value }}.open" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="w-1/2">
                                    <div class="p-2">
                                        <x-label for="open_hours_{{ $day->value }}_close" value="{{ __('Close') }}"/>
                                        <x-input id="open_hours_{{ $day->value }}_close"
                                                 name="open_hours[{{ $day->value }}][close]"
                                                 type="time" class="mt-1 block w-full"
                                                 value='{{ old("open_hours.$day->value.close") }}'
                                        />
                                        <x-input-error for="open_hours.{{ $day->value }}.close" class="mt-2"/>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="w-full md:w-1/2 lg:w-2/3 xl:w-1/2">
                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 p-2">
                            <x-label for="street_name" value="{{ __('Street name') }}"/>
                            <x-input id="street_name" name="street_name" type="text" class="mt-1 block w-full"
                                     value="{{ old('street_name') }}"
                            />
                            <x-input-error for="street_name" class="mt-2"/>
                        </div>
                        <div class="w-1/2 sm:w-1/4 md:w-1/2 lg:w-1/4 p-2">
                            <x-label for="street_number" value="{{ __('Street number') }}"/>
                            <x-input id="street_number" name="street_number" type="text" class="mt-1 block w-full"
                                     value="{{ old('street_number') }}"
                            />
                            <x-input-error for="street_number" class="mt-2"/>
                        </div>
                        <div class="w-1/2 sm:w-1/4 md:w-1/2 lg:w-1/4 p-2">
                            <x-label for="apartment_number" value="{{ __('Apartment number') }}"/>
                            <x-input id="apartment_number" name="apartment_number" type="text" class="mt-1 block w-full"
                                     value="{{ old('apartment_number') }}"
                            />
                            <x-input-error for="apartment_number" class="mt-2"/>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 p-2">
                            <x-label for="zip_code" value="{{ __('Zip code') }}"/>
                            <x-input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full"
                                     value="{{ old('zip_code') }}"
                            />
                            <x-input-error for="zip_code" class="mt-2"/>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 p-2">
                            <x-label for="city" value="{{ __('City') }}"/>
                            <x-input id="city" name="city" type="text" class="mt-1 block w-full"
                                     value="{{ old('city') }}"
                            />
                            <x-input-error for="city" class="mt-2"/>
                        </div>
                        <div class="w-1/2 md:w-full lg:w-1/2 p-2">
                            <x-label for="latitude" value="{{ __('Latitude') }}"/>
                            <x-input id="latitude" name="latitude" type="text" class="mt-1 block w-full"
                                     value="{{ old('latitude') }}"
                            />
                            <x-input-error for="latitude" class="mt-2"/>
                        </div>
                        <div class="w-1/2 md:w-full lg:w-1/2 p-2">
                            <x-label for="longitude" value="{{ __('Longitude ') }}"/>
                            <x-input id="longitude" name="longitude" type="text" class="mt-1 block w-full"
                                     value="{{ old('longitude') }}"
                            />
                            <x-input-error for="longitude" class="mt-2"/>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </x-page-body>

</x-app-layout>
