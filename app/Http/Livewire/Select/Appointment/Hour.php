<?php

namespace App\Http\Livewire\Select\Appointment;

use App\Actions\Company\Service\GetServiceAvailableHours;
use App\Models\Service;
use Livewire\Component;

class Hour extends Component
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
        return view('livewire.select.appointment.hour');
    }
}
