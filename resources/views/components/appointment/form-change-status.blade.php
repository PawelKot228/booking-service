@props([
    'company' => null,
    'appointment' => null,
])

<form action="{{ route('users.companies.appointments.change-status', [$company, $appointment]) }}"
      method="POST"
>
    @csrf
    @method('PATCH')
    @if($appointment->status === \App\Enums\AppointmentStatus::PENDING->value)
        <x-button-success name="status" value="{{ \App\Enums\AppointmentStatus::ACCEPTED->value }}">
            {{ __('Accept') }}
        </x-button-success>

        <x-button-danger name="status" value="{{ \App\Enums\AppointmentStatus::REJECTED->value }}">
            {{ __('Reject') }}
        </x-button-danger>
    @elseif($appointment->status === \App\Enums\AppointmentStatus::ACCEPTED->value)
        <x-button-success name="status" value="{{ \App\Enums\AppointmentStatus::FINISHED->value }}">
            {{ __('Finalize') }}
        </x-button-success>
    @endif

</form>
