<?php

namespace App\Http\Resources;

use App\Http\Requests\AvailableAppointmentRequest;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Service */
class ScheduleAppointmentResource extends JsonResource
{
    public function toArray(AvailableAppointmentRequest|Request $request): array
    {
        $serviceService = new ServiceService();

        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'company_category_id' => $this->company_category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'currency' => $this->currency,
            'appointmentUrl' => route('users.appointments.store'),
            'availableAppointments' => $serviceService->getAvailableHours($this),
            'openDays' => $serviceService->getAvailableDays($this),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }


}
