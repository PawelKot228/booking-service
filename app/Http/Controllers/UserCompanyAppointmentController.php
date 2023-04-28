<?php

namespace App\Http\Controllers;

use App\Models\Company;
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

    public function store(Request $request)
    {
    }

    public function show(Company $company, $appointment)
    {
        $appointment = $company->appointments()->findOrFail($appointment);

        return view('pages.users.companies.appointments.edit', compact('appointment'));
    }

    public function edit(Company $company, $appointment)
    {
        $appointment = $company->appointments()->findOrFail($appointment);

        return view('pages.users.companies.appointments.edit', compact('appointment'));
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
        } catch (\Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));
        }

        return to_route('users.companies.appointments.index', [$company]);
    }
}
