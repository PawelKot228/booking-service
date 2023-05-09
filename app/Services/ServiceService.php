<?php

namespace App\Services;

use App\Enums\Day;
use App\Http\Resources\ScheduleAppointmentResource;
use App\Models\CompanyCategory;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;

class ServiceService
{

    public function getAvailableDays(Service|ScheduleAppointmentResource $service): array
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

    public function getAvailableHours(Service|ScheduleAppointmentResource $service): array
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

    public function save(CompanyCategory $companyCategory, Request $request): ?Service
    {
        try {
            $service = $companyCategory->services()->create($request->validated());
        } catch (Exception $exception) {
            logError($exception);

            return null;
        }

        return $service;
    }


    public function update(Service $service, Request $request): bool
    {
        try {
            $service->fill($request->validated())->save();
        } catch (Exception $exception) {
            logError($exception);

            return false;
        }

        return true;
    }

}
