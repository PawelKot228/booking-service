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
                <x-appointment.form-change-status :company="$company" :appointment="$appointment"/>
            </x-slot:buttons>
        </x-leading-text-header>


        <div class="flex flex-wrap my-4 gap-y-2">
            <div class="w-full sm:w-1/2 xl:w-1/3 px-4">
                <form action="{{ route('users.companies.appointments.update', [$company, $appointment]) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')
                    <x-simple-card>
                        <x-slot:header>
                            <h3 class="font-semibold text-xl">
                                {{ __('Details') }}
                            </h3>
                        </x-slot:header>

                        <x-slot:buttons>
                            <x-button-small>
                                {{ __('Save') }}
                            </x-button-small>
                        </x-slot:buttons>

                        <livewire:appointment.schedule-selects
                            companyId="{{ $company->id }}"
                            appointmentId="{{ $appointment->id }}"
                        />

                        <div class="p-2">
                            <x-label for="employee_id" value="{{ __('Employee') }}"/>
                            <livewire:select.company-employees
                                companyId="{{ $company->id }}"
                                appointmentEmployeeId="{{ $appointment->employee_id }}"
                            />
                            <x-input-error for="employee_id" class="mt-2"/>
                        </div>
                    </x-simple-card>
                </form>
            </div>
            <div class="w-full sm:w-1/2 xl:w-1/3 px-4">
                <x-appointment.card.base-info :appointment="$appointment"/>
            </div>

            <div class="w-full sm:w-1/2 xl:w-1/3 px-4">
                <x-appointment.card.customer :appointment="$appointment"/>
            </div>
        </div>

    </x-page-body>
</x-app-layout>
