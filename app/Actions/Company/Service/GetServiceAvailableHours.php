<?php

namespace App\Actions\Company\Service;

use App\Enums\Day;
use App\Http\Resources\ServiceAppointmentListResource;
use App\Models\Service;

class GetServiceAvailableHours
{
    public function handle(Service|ServiceAppointmentListResource $service): array
    {
        $currentDay = Day::getDayOfTheWeek(now()->dayOfWeekIso);
        $openHours = $service->company->open_hours[$currentDay->value] ?? [];

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
            $endOfAppointmentTime = $currentTime->clone()->addMinutes($service->duration);

            $hasAppointmentsDuringWork = false;

            foreach ($service->appointments as $appointment) {

                if ($appointment->to->subSecond()->isBetween($currentTime, $endOfAppointmentTime)) {
                    $hasAppointmentsDuringWork = true;
                    break;
                }
            }

            if ($hasAppointmentsDuringWork) {
                $currentTime = $currentTime->addMinutes($service->duration);
                continue;
            }

            $appointmentTime = [
                'time' => $currentTime->toTimeString('minute'),
                'available' => true,
            ];

            $currentTime = $currentTime->addMinutes($service->duration);

            if ($currentTime > $closeTime) {
                break;
            }

            $appointmentHours[] = $appointmentTime;
        }

        return $appointmentHours;
    }


}
