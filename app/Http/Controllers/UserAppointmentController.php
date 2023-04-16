<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAppointmentStoreRequest;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAppointmentController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $appointments = Appointment::with(['company', 'service', 'employee'])
            ->where('user_id', $user->getKey())
            ->paginate(5);

        return view('pages.users.appointments.index', compact('appointments'));
    }

    public function store(UserAppointmentStoreRequest $request): JsonResponse
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

        return response()->json($appointment);
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['service', 'company', 'employee']);

        return view('pages.users.appointments.show', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
    }

    public function destroy(Appointment $appointment)
    {
    }
}
