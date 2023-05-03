<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <x-page-body>
        <div class="space-y-6 py-6 px-3">
            @foreach($appointments as $appointment)
                <div class="flex bg-fuchsia-100 bg-opacity-50 shadow-xl p-2 rounded-md">
                    <div class="w-1/2 p-4 border-r-2 border-black-100">
                        <p class="text-2xl">
                            {{ $appointment->company->name }} <br>
                        </p>
                        <p>
                            {{ __('Employee') }}: {{ $appointment->employee?->name }}
                        </p>
                        <p>
                            {{ __('Price') }}: {{ $appointment->price }} {{ $appointment->service->currency }}
                        </p>
                    </div>
                    <div class="w-1/2 p-4">
                        <p class="text-2xl">
                            {{ $appointment->from->isoFormat('D MMMM') }}
                        </p>
                        <p class="text-xl">
                            {{ $appointment->from->format('H:i') }}
                        </p>
                        <x-button-link
                            :href="route('users.appointments.show', ['appointment' => $appointment->getKey()])">
                            {{ __('Show details') }}
                        </x-button-link>
                    </div>
                </div>
            @endforeach

            {!! $appointments->links() !!}

        </div>
    </x-page-body>

</x-app-layout>
