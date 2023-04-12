<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceAppointmentListResource;
use App\Models\Appointment;
use App\Models\Company;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function availableList($company, $service)
    {
        $service = Service::with('company')
            ->has('company')
            ->findOrFail($service);


        return (new ServiceAppointmentListResource($service));
    }

    public function index($company, $service)
    {
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
