<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Service */
class ServiceAppointmentListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $openTime = now()->setTime(6, 0);
        $closeTime = now()->setTime(20, 0);
        $currentTime = $openTime->clone();
        $appointmentHours = [];

        while($currentTime < $closeTime) {
            $appointmentTime = [
                'time' => $currentTime->toTimeString('minute'),
                'available' => true,
            ];

            $currentTime = $currentTime->addMinutes($this->duration);

            if ($currentTime > $closeTime) {
                break;
            }

            $appointmentHours[] = $appointmentTime;
        }

        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'company_category_id' => $this->company_category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'currency' => $this->currency,
            'availableAppointments' => $appointmentHours,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
