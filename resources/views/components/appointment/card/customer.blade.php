@props(['appointment' => null])

<x-simple-card>
    <x-slot:header>
        <h3 class="font-semibold text-xl">
            {{ __('Customer') }}
        </h3>
    </x-slot:header>

    <x-company.detail-row>
        <x-slot:header>
            {{ __('Name') }}
        </x-slot:header>

        {{ $appointment->customer->name }}
    </x-company.detail-row>

    <x-company.detail-row>
        <x-slot:header>
            {{ __('E-mail') }}
        </x-slot:header>

        {{ $appointment->customer->email }}
    </x-company.detail-row>

    <x-company.detail-row>
        <x-slot:header>
            {{ __('Verified') }}
        </x-slot:header>

        <x-bool-badge :value="$appointment->customer->email_verified_at !== null" />
    </x-company.detail-row>

</x-simple-card>
