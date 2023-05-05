@props(['appointment' => null])

<x-simple-card>
    <x-slot:header>
        <h3 class="font-semibold text-xl">
            {{ __('Base info') }}
        </h3>
    </x-slot:header>

    <x-company.detail-row>
        <x-slot:header>
            {{ __('Status') }}
        </x-slot:header>

        <x-appointment.status-badge :status="$appointment->status" />
    </x-company.detail-row>

    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">

    <x-company.detail-row>
        <x-slot:header>
            {{ __('Employee') }}
        </x-slot:header>

        {{ $appointment->employee?->name ?? __('Not assigned') }}
    </x-company.detail-row>

    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">

    <x-company.detail-row>
        <x-slot:header>
            {{ __('Day') }}
        </x-slot:header>

        {{ $appointment->from->isoFormat('D MMMM') }}
    </x-company.detail-row>

    <x-company.detail-row>
        <x-slot:header>
            {{ __('Time frame') }}
        </x-slot:header>

        {{ $appointment->from->format('H:i') }} - {{ $appointment->to->format('H:i') }}
    </x-company.detail-row>

    <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">

    <x-company.detail-row>
        <x-slot:header>
            {{ __('Service') }}
        </x-slot:header>

        {{ $appointment->service->name }}
    </x-company.detail-row>

    <x-company.detail-row>
        <x-slot:header>
            {{ __('Category') }}
        </x-slot:header>

        {{ $appointment->service->category->category }}
    </x-company.detail-row>

    <x-company.detail-row>
        <x-slot:header>
            {{ __('Subcategory') }}
        </x-slot:header>

        {{ $appointment->service->category->subcategory }}
    </x-company.detail-row>

    <x-company.detail-row>
        <x-slot:header>
            {{ __('Price') }}
        </x-slot:header>

        {{ $appointment->service->price }} {{ $appointment->service->currency }}
    </x-company.detail-row>

</x-simple-card>
