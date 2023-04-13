<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAppointmentStoreRequest;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserAppointmentController extends Controller
{
    public function index()
    {
    }

    public function store(UserAppointmentStoreRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $service = Service::findOrFail($request->service_id);

        $from = Carbon::parse($request->from);

        $appointment = $user->appointments()->create([
            ...$request->toArray(),
            'company_id' => $service->company_id,
            'to' => $from->addMinutes($service->duration),
            'price' => $service->price,
        ]);


        return $appointment;
    }

    public function show(Appointment $appointment)
    {
    }

    public function update(Request $request, Appointment $appointment)
    {
    }

    public function destroy(Appointment $appointment)
    {
    }
}