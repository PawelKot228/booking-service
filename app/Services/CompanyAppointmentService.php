<?php

namespace App\Services;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use App\Models\Company;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class CompanyAppointmentService
{

    public function save(Company $company, Request $request): ?Appointment
    {
        try {
            $user = User::where('email', $request->user_id)->firstOrFail();
            $service = Service::findOrFail($request->service_id);

            $fromDate = Carbon::parse("$request->day $request->hour");
            $appointment = $company->appointments()->create([
                ...$request->validated(),
                'user_id' => $user->id,
                'status' => AppointmentStatus::ACCEPTED->value,
                'price' => $service->price,
                'currency' => $service->currency,
                'from' => $fromDate,
                'to' => $fromDate->clone()->addMinutes($service->duration),
            ]);

        } catch (Exception $exception) {
            logError($exception);

            return null;
        }

        return $appointment;
    }

    public function update(Appointment $appointment, Request $request)
    {
        try {
            $fromDate = Carbon::parse("$request->day $request->hour");
            $appointment->update([
                'from' => $fromDate,
                'to' => $fromDate->clone()->addMinutes($appointment->service->duration),
                'employee_id' => $request->employee_id,
            ]);

            flashSuccessNotification(__('Successfully updated an appointment'));
        } catch (Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

        return true;
    }
}
