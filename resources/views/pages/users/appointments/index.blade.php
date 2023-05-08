<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <x-page-body>
        <div class="space-y-6 py-6 px-3">
            @foreach($appointments as $appointment)
                <div class="flex bg-violet-300 bg-opacity-30 shadow-xl p-2 rounded-md">
                    <div class="w-1/2 p-4 border-r-2 border-black-100">
                        <p class="text-2xl">
                            {{ $appointment->company->name }} <br>
                        </p>
                        <x-company.detail-row>
                            <x-slot:header>
                                {{ __('Status') }}
                            </x-slot:header>

                            <x-appointment.status-badge :status="$appointment->status"/>
                        </x-company.detail-row>

                        <hr class="h-px my-1 bg-gray-200 border-0 dark:bg-gray-700">

                        <x-company.detail-row>
                            <x-slot:header>
                                {{ __('Employee') }}
                            </x-slot:header>

                            {{ $appointment->employee?->name ?? __('Not assigned') }}
                        </x-company.detail-row>

                        <hr class="h-px my-1 bg-gray-200 border-0 dark:bg-gray-700">

                        <x-company.detail-row>
                            <x-slot:header>
                                {{ __('Price') }}
                            </x-slot:header>

                            {{ $appointment->price }} {{ $appointment->service->currency }}
                        </x-company.detail-row>
                    </div>
                    <div class="w-1/2 p-4">
                        <x-company.detail-row class="text-2xl">
                            <x-slot:header>
                                {{ __('Day') }}
                            </x-slot:header>

                            {{ $appointment->from->isoFormat('D MMMM') }}
                        </x-company.detail-row>

                        <x-company.detail-row class="text-xl">
                            <x-slot:header>
                                {{ __('Time frame') }}
                            </x-slot:header>

                            {{ $appointment->from->format('H:i') }} - {{ $appointment->to->format('H:i') }}
                        </x-company.detail-row>

                        <x-button-link
                            class="mt-1 md:mt-3 block"
                            href="{{ route('users.appointments.show', ['appointment' => $appointment->getKey()]) }}"
                        >
                            {{ __('Show details') }}
                        </x-button-link>
                    </div>
                </div>
            @endforeach

            {!! $appointments->links() !!}

        </div>
    </x-page-body>

</x-app-layout>
