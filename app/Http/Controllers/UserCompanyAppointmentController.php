<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Company;
use Illuminate\Http\Request;

class UserCompanyAppointmentController extends Controller
{
    public function index(Company $company)
    {
        $company->load(['appointments' => ['service', 'customer', 'employee']]);

        return view('pages.users.companies.appointments.index', compact('company'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Appointment $appointment)
    {
    }

    public function edit(Appointment $appointment)
    {
    }

    public function update(Request $request, Appointment $appointment)
    {
    }

    public function destroy(Appointment $appointment)
    {
    }
}
