<?php

namespace App\Http\Resources;

use App\Http\Requests\AvailableAppointmentsRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Service */
class ServiceAppointmentListResource extends JsonResource
{
    public function toArray(AvailableAppointmentsRequest|Request $request): array
    {
        //$openDay = Carbon::parse($request->date);
        $openTime = now()->setTime(6, 0);
        $closeTime = now()->setTime(20, 0);
        $currentTime = $openTime->clone();
        $appointmentHours = [];

        while ($currentTime < $closeTime) {
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

        $openDay = today();
        $openDays = [];
        while (count($openDays) <= 20) {
            $openDays[] = $openDay->toDateString();
            $openDay->addDay();
        }

        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'company_category_id' => $this->company_category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'currency' => $this->currency,
            'appointmentUrl' => route('users.appointments.store'),
            'availableAppointments' => $appointmentHours,
            'openDays' => $openDays,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
