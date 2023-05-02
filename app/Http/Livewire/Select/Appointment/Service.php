<?php

namespace App\Http\Livewire\Select\Appointment;

use App\Models\CompanyCategory;
use Livewire\Component;

class Service extends Component
{
    public int $companyId;
    public ?int $serviceId = null;

    public function change(): void
    {
        $this->emit('serviceChanged', $this->companyId, $this->serviceId);
    }

    public function render()
    {
        $categories = CompanyCategory::with(['services'])
            ->where('company_id', $this->companyId)
            ->get();

        return view('livewire.select.appointment.service', compact('categories'));
    }
}
