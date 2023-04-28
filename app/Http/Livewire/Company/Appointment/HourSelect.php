<?php

namespace App\Http\Livewire\Company\Appointment;

use App\Actions\Company\Service\GetServiceAvailableHours;
use App\Models\Service;
use Livewire\Component;

class HourSelect extends Component
{
    protected $listeners = ['dayChanged' => 'change'];

    public array $hours = [];
    public ?string $hour = null;

    public function change($companyId, $serviceId): void
    {
        $service = Service::findOrFail($serviceId);

        $this->hours = (new GetServiceAvailableHours())->handle($service);
    }

    public function render()
    {
        return view('livewire.company.appointment.hour-select');
    }
}
