<?php

namespace App\Http\Resources;

use App\Actions\Company\Service\GetServiceAvailableDays;
use App\Actions\Company\Service\GetServiceAvailableHours;
use App\Enums\Day;
use App\Http\Requests\AvailableAppointmentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Service */
class ServiceAppointmentListResource extends JsonResource
{
    public function toArray(AvailableAppointmentRequest|Request $request): array
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'company_category_id' => $this->company_category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'currency' => $this->currency,
            'appointmentUrl' => route('users.appointments.store'),
            'availableAppointments' => (new GetServiceAvailableHours)->handle($this),
            'openDays' => (new GetServiceAvailableDays())->handle($this),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }


}
