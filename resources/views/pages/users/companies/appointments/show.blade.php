<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }}
        </h2>
    </x-slot>

    {{ Breadcrumbs::renderCompany($appointment, $company) }}

    <x-page-body>
        <x-leading-text-header class="text-2xl">
            {{ __('Appointment') }} #{{$appointment->id}}

            <x-slot:buttons>
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
                        <x-button-success name="status" value="{{ \App\Enums\AppointmentStatus::FINISHED->value }}"
                        >
                            {{ __('Finalize') }}
                        </x-button-success>
                    @endif

                </form>
            </x-slot:buttons>
        </x-leading-text-header>


        <div class="flex flex-wrap my-4">
            <div class="w-full sm:w-1/2 xl:w-1/3 px-4">
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
            </div>

            <div class="w-full sm:w-1/2 xl:w-1/3 px-4">
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
            </div>
        </div>

    </x-page-body>
</x-app-layout>
