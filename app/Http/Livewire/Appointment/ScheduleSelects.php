<?php

namespace App\Http\Livewire\Appointment;

use App\Actions\Company\Service\GetServiceAvailableDays;
use App\Actions\Company\Service\GetServiceAvailableHours;
use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\CompanyCategory;
use App\Models\Service;
use Livewire\Component;

class ScheduleSelects extends Component
{
    public ?int $appointmentId = null;
    public int $companyId;
    public ?int $serviceId = null;

    public string $day;
    public string $hour;

    public bool $disabledServices = false;
    public bool $disabledInputs = false;


    public function mount(int $companyId, ?int $appointmentId = null)
    {
        $this->companyId = $companyId;
        $this->appointmentId = $appointmentId;
    }

    public function render()
    {
        $categories = CompanyCategory::with(['services'])->where('company_id', $this->companyId)->get();

        $appointment = Appointment::find($this->appointmentId);
        $service = Service::find($this->serviceId ?? $appointment?->service_id);

        if ($appointment) {
            $this->serviceId ??= $appointment->service_id;
            $this->disabledServices = true;
            $this->disabledInputs = $appointment->isFinished();

            $this->day ??= $appointment->from->format('Y-m-d');
            $this->hour ??= $appointment->from->format('H:i');
        }

        $hours = collect();
        $days = collect();
        if ($service) {
            $hours = collect((new GetServiceAvailableHours())->handle($service));
            $days = collect((new GetServiceAvailableDays())->handle($service));
        }

        if ($appointment?->from->is($this->day ?? '')) {
            $hours = $hours->push([
                'time' => $appointment->from->format('H:i'),
                'available' => true,
            ])->sortBy('time');
        }


        return view('livewire.appointment.schedule-selects', compact('categories', 'days', 'hours'));
    }
}
