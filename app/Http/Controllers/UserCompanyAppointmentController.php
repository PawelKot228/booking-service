<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatus;
use App\Enums\EmployeeRole;
use App\Http\Requests\Company\AppointmentChangeStatusRequest;
use App\Http\Requests\Company\AppointmentStoreRequest;
use App\Http\Requests\Company\AppointmentUpdateRequest;
use App\Models\Company;
use App\Services\CompanyAppointmentService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;

class UserCompanyAppointmentController extends Controller
{
    public function __construct(
        private readonly CompanyAppointmentService $appointmentService
    ) {
        $this->middleware('company:'.EmployeeRole::EMPLOYEE->value)
            ->only(['index', 'show', 'changeStatus']);
        $this->middleware('company:'.EmployeeRole::MANAGER->value)
            ->except(['index', 'show', 'changeStatus']);
    }

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
        $appointment = $this->appointmentService->save($company, $request);

        if (!$appointment) {
            flashErrorNotification(__('Unexpected error occurred'));
            return redirect()->back();
        }

        flashSuccessNotification(__('Successfully created an appointment!'));

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

    public function update(AppointmentUpdateRequest $request, Company $company, $appointment): RedirectResponse
    {
        $appointment = $company->appointments()->findOrFail($appointment);

        if ($appointment->isFinished()) {
            flashWarningNotification(__('Appointment is finished. Changing details is not possible'));
            return redirect()->back();
        }

        if (!$this->appointmentService->update($appointment, $request)) {
            flashErrorNotification(__('Unexpected error occurred'));
            return redirect()->back();
        }

        flashSuccessNotification(__('Successfully updated an appointment'));

        return to_route('users.companies.appointments.edit', [$company, $appointment]);
    }

    public function changeStatus(
        AppointmentChangeStatusRequest $request,
        Company $company,
        $appointment
    ): RedirectResponse {
        $appointment = $company->appointments()->findOrFail($appointment);

        if (
            $appointment->status === AppointmentStatus::PENDING->value
            && !in_array($request->status, [AppointmentStatus::ACCEPTED->value, AppointmentStatus::REJECTED->value])
        ) {
            flashErrorNotification(__('Cannot change Pending status, wrong status was given'));
            return redirect()->back();
        }

        if (
            $appointment->status === AppointmentStatus::ACCEPTED->value
            && $request->status !== AppointmentStatus::FINISHED->value
        ) {
            flashErrorNotification(__('Cannot change Accepted status, wrong status was given'));
            return redirect()->back();
        }

        if ($request->status === AppointmentStatus::FINISHED->value && $appointment->to->greaterThan(now())) {
            flashErrorNotification(__('Appointment can be finished after scheduled time passes'));
            return redirect()->back();
        }

        $appointment->update(['status' => $request->status]);

        flashSuccessNotification(__('Successfully changed status!'));

        return redirect()->back();
    }

    public function destroy(Company $company, $appointment): RedirectResponse
    {
        try {
            $appointment = $company->appointments()->findOrFail($appointment);
            $appointment->delete();

            flashSuccessNotification(__('Successfully deleted!'));
        } catch (ModelNotFoundException) {
            flashErrorNotification(__("Could not find Appointment"));
        } catch (Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));
        }

        return to_route('users.companies.appointments.index', [$company]);
    }
}
