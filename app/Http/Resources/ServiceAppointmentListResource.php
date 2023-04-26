<?php

namespace App\Http\Resources;

use App\Enums\Day;
use App\Http\Requests\AvailableAppointmentsRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Service */
class ServiceAppointmentListResource extends JsonResource
{
    public function toArray(AvailableAppointmentsRequest|Request $request): array
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
            'availableAppointments' => $this->getAvailableHours(),
            'openDays' => $this->getOpenDays(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    private function getAvailableHours(): array
    {
        $currentDay = Day::getDayOfTheWeek(now()->dayOfWeekIso);
        $openHours = $this->category->company->open_hours[$currentDay->value] ?? [];

        if (empty($openHours)) {
            return [];
        }

        [$openHour, $openMinute] = explode(':', $openHours['open']);
        [$closeHour, $closeMinute] = explode(':', $openHours['close']);

        $openTime = today()->setTime($openHour, $openMinute);
        $closeTime = now()->setTime($closeHour, $closeMinute);
        $currentTime = $openTime->clone();

        $appointmentHours = [];
        while ($currentTime < $closeTime) {
            $endOfAppointmentTime = $currentTime->clone()->addMinutes($this->duration);

            $hasAppointmentsDuringWork = false;

            foreach ($this->appointments as $appointment) {

                if ($appointment->to->subSecond()->isBetween($currentTime, $endOfAppointmentTime)) {
                    $hasAppointmentsDuringWork = true;
                    break;
                }
            }

            if ($hasAppointmentsDuringWork) {
                $currentTime = $currentTime->addMinutes($this->duration);
                continue;
            }

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

        return $appointmentHours;
    }

    private function getOpenDays(): array
    {
        $openDay = today();
        $openHours = $this->category->company->open_hours ?? [];

        if (empty($openHours)) {
            return [];
        }

        $openDays = [];
        while (count($openDays) <= 20) {
            $currentDay = Day::getDayOfTheWeek($openDay->dayOfWeekIso);

            if (!isset($openHours[$currentDay->value])) {
                continue;
            }

            $openDays[] = $openDay->toDateString();
            $openDay->addDay();
        }

        return $openDays;
    }
}
