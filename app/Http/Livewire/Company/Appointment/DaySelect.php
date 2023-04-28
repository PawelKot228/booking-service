<?php

namespace App\Http\Livewire\Company\Appointment;

use App\Actions\Company\Service\GetServiceAvailableDays;
use App\Models\Company;
use App\Models\Service;
use Livewire\Component;

class DaySelect extends Component
{
    protected $listeners = ['serviceChanged' => 'change'];

    public array $days = [];
    public ?string $day = null;

    public $company;

    public ?int $companyId = null;
    public ?int $serviceId = null;

    public function change($company, $service): void
    {
        $service = Service::with('company')->findOrFail($service);

        $this->serviceId = $service->id;
        $this->companyId = $service?->company?->id;

        $this->days = (new GetServiceAvailableDays())->handle($service);
    }

    public function selectedDay(): void
    {
        $this->emit('dayChanged', $this->companyId, $this->serviceId);
    }

    public function render()
    {
        return view('livewire.company.appointment.day-select');
    }
}
