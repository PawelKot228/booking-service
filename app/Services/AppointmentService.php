<?php

namespace App\Services;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentService
{
    public function save(User $user, Service $service, Request $request): ?Appointment
    {
        try {
            $from = Carbon::parse($request->from);

            $appointment = $user->appointments()->create([
                ...$request->validated(),
                'company_id' => $service->category->company_id,
                'to' => $from->addMinutes($service->duration),
                'price' => $service->price,
            ]);
        } catch (\Exception $exception) {
            logError($exception);

            return null;
        }

        return $appointment;
    }

    public function cancelAppointment(Appointment $appointment): bool
    {
        try {
            $appointment->update(['status' => AppointmentStatus::CANCELLED->value]);

            flashSuccessNotification(__('Successfully cancelled appointment'));
        } catch (\Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));

            return false;
        }

        return true;
    }
}
