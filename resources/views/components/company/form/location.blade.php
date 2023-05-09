@props(['company' => null])

<div class="flex flex-wrap">
    <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 p-2">
        <x-label for="street_name" value="{{ __('Street name') }}"/>
        <x-input id="street_name" name="street_name" type="text" class="mt-1 block w-full"
                 value="{{ old('street_name') ?? $company?->street_name }}"
        />
        <x-input-error for="street_name" class="mt-2"/>
    </div>
    <div class="w-1/2 sm:w-1/4 md:w-1/2 lg:w-1/4 p-2">
        <x-label for="street_number" value="{{ __('Street number') }}"/>
        <x-input id="street_number" name="street_number" type="text" class="mt-1 block w-full"
                 value="{{ old('street_number') ?? $company?->street_number }}"
        />
        <x-input-error for="street_number" class="mt-2"/>
    </div>
    <div class="w-1/2 sm:w-1/4 md:w-1/2 lg:w-1/4 p-2">
        <x-label for="apartment_number" value="{{ __('Apartment number') }}"/>
        <x-input id="apartment_number" name="apartment_number" type="text" class="mt-1 block w-full"
                 value="{{ old('apartment_number') ?? $company?->apartment_number }}"
        />
        <x-input-error for="apartment_number" class="mt-2"/>
    </div>
    <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 p-2">
        <x-label for="zip_code" value="{{ __('Zip code') }}"/>
        <x-input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full"
                 value="{{ old('zip_code') ?? $company?->zip_code }}"
        />
        <x-input-error for="zip_code" class="mt-2"/>
    </div>
    <div class="w-full sm:w-1/2 md:w-full lg:w-1/2 p-2">
        <x-label for="city" value="{{ __('City') }}"/>
        <x-input id="city" name="city" type="text" class="mt-1 block w-full"
                 value="{{ old('city') ?? $company?->city }}"
        />
        <x-input-error for="city" class="mt-2"/>
    </div>
    <div class="w-1/2 md:w-full lg:w-1/2 p-2">
        <x-label for="latitude" value="{{ __('Latitude') }}"/>
        <x-input id="latitude" name="latitude" type="text" class="mt-1 block w-full"
                 value="{{ old('latitude') ?? $company?->latitude }}"
        />
        <x-input-error for="latitude" class="mt-2"/>
    </div>
    <div class="w-1/2 md:w-full lg:w-1/2 p-2">
        <x-label for="longitude" value="{{ __('Longitude ') }}"/>
        <x-input id="longitude" name="longitude" type="text" class="mt-1 block w-full"
                 value="{{ old('longitude') ?? $company?->longitude }}"
        />
        <x-input-error for="longitude" class="mt-2"/>
    </div>
</div>
