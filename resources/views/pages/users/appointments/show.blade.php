<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment for') }} {{ $appointment->company->name }}
        </h2>
    </x-slot>


    <x-page-body>
        <x-leading-text-header class="text-2xl">
            {{ __('Appointment') }} #{{$appointment->id}}

            <x-slot:buttons>
{{--                <x-button-link-warning :href="route('home')">--}}
{{--                    {{ __('Reschedule') }}--}}
{{--                </x-button-link-warning>--}}

                <form class="delete-action inline-block"
                      method="POST"
                      action="{{ route('users.appointments.destroy', [$appointment]) }}"
                >
                    @csrf
                    @method('DELETE')

                    <x-button-danger >
                        {{ __('Cancel Appointment') }}
                    </x-button-danger>
                </form>

            </x-slot:buttons>
        </x-leading-text-header>

        <div class="flex flex-wrap my-4 gap-y-2">
            <div class="w-full sm:w-1/2 px-4">
                <x-appointment.card.base-info :appointment="$appointment" />
            </div>
        </div>

    </x-page-body>
</x-app-layout>
