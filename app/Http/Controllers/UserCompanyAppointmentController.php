<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatus;
use App\Http\Requests\Company\AppointmentStoreRequest;
use App\Models\Company;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserCompanyAppointmentController extends Controller
{
    public function index(Company $company)
    {
        $company->load(['appointments' => ['service', 'customer', 'employee']]);

        return view('pages.users.companies.appointments.index', compact('company'));
    }

    public function create(Company $company)
    {
        return view('pages.users.companies.appointments.create', compact('company'));
    }

    public function store(AppointmentStoreRequest $request, Company $company): RedirectResponse
    {
        try {
            $user = User::where('email', $request->user_id)->firstOrFail();
            $service = Service::findOrFail($request->service_id);

            $fromDate = Carbon::parse("$request->day $request->hour");
            $appointment = $company->appointments()->create([
                ...$request->validated(),
                'user_id' => $user->id,
                'status' => AppointmentStatus::ACCEPTED,
                'price' => $service->price,
                'currency' => $service->currency,
                'from' => $fromDate,
                'to' => $fromDate->clone()->addMinutes($service->duration),
            ]);

            flashSuccessNotification(__('Successfully created an appointment!'));
        } catch (Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

        return to_route('users.companies.appointments.show', [$company, $appointment]);
    }

    public function show(Company $company, $appointment)
    {
        $appointment = $company->appointments()->findOrFail($appointment);

        return view('pages.users.companies.appointments.show', compact('company', 'appointment'));
    }

    public function edit(Company $company, $appointment)
    {
        $appointment = $company->appointments()->findOrFail($appointment);

        return view('pages.users.companies.appointments.edit', compact('company', 'appointment'));
    }

    public function update(Request $request, Company $company, $appointment)
    {
    }

    public function destroy(Company $company, $appointment): RedirectResponse
    {
        try {
            $appointment = $company->appointments()->findOrFail($appointment);
            $appointment->delete();

            flashSuccessNotification(__('Successfully deleted!'));
        } catch (ModelNotFoundException $exception) {
            flashErrorNotification(__("Could not find Appointment"));
        } catch (Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));
        }

        return to_route('users.companies.appointments.index', [$company]);
    }
}
