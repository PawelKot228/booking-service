<?php

namespace App\Actions\Company\Service;

use App\Enums\Day;
use App\Http\Resources\ServiceAppointmentListResource;
use App\Models\Service;

class GetServiceAvailableDays
{
    public function handle(Service|ServiceAppointmentListResource $service): array
    {
        $openDay = today();
        $openHours = $service->company->open_hours ?? [];

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
