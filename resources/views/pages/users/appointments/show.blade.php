<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment for') }} {{ $appointment->company->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 md:p-8">
                <h2 class="font-semibold text-xl md:text-2xl text-gray-800 leading-tight mb-4">
                    {{ $appointment->service->name }}
                </h2>

                <div class="flex">
                    <div class="w-1/2">
                        <p class="font-semibold text-xl text-gray-800 leading-tight mb-1">
                            {{ __('Address') }}
                        </p>
                        <p class="text-xl text-gray-800 leading-tight">
                            {{ $appointment->company->getFormattedStreet() }}
                            <br>
                            {{ $appointment->company->zip_code }} {{ $appointment->company->city }}
                        </p>
                    </div>
                    <div class="w-1/2 text-center">
                        <h4 class="font-semibold text-xl">
                            {{ __('Time of the appointment') }}
                        </h4>
                        <p class="font-semibold text-xl">
                            {{ $appointment->from->isoFormat('D MMMM') }}
                        </p>
                        <p class="text-xl">
                            {{ $appointment->from->format('H:i') }} - {{ $appointment->to->format('H:i') }}
                        </p>
                    </div>

                </div>
                    <div class="py-4">
{{--                        TODO:add functionality               --}}
                        <x-button-link-warning :href="route('home')">
                            {{ __('Reschedule') }}
                        </x-button-link-warning>
                        <x-button-link-danger :href="route('home')">
                            {{ __('Cancel Appointment') }}
                        </x-button-link-danger>
                    </div>

            </div>
        </div>
    </div>
</x-app-layout>