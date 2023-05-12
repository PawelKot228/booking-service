<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAppointmentStoreRequest;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use App\Services\AppointmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct(private readonly AppointmentService $appointmentService)
    {
    }

    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $appointments = Appointment::with(['company', 'service', 'employee', 'review'])
            ->where('user_id', $user->getKey())
            ->paginate(5);

        return view('pages.users.appointments.index', compact('appointments'));
    }

    public function store(UserAppointmentStoreRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $service = Service::with(['category'])->findOrFail($request->service_id);

        $appointment = $this->appointmentService->save($user, $service, $request);

        if (!$appointment) {
            return response()->json(['message' => __('Unexpected error occurred')], 400);
        }

        return response()->json($appointment);
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['service', 'company', 'employee']);

        return view('pages.users.appointments.show', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->id !== $appointment->user_id) {
            flashErrorNotification(__('Appointment does not belong to you'));
            return redirect()->back();
        }

        if (!$appointment->isPending() && !$appointment->isAccepted() && $appointment->from->lessThan(now()->subHour())) {
            flashErrorNotification(__('Only appointments with Pending/Accepted status and hour before scheduled time can be cancelled.'));
            return redirect()->back();
        }

        $updateSuccessful = $this->appointmentService->cancelAppointment($appointment);

        if (!$updateSuccessful) {
            flashErrorNotification(__('Unexpected error occurred'));
            return redirect()->back();
        }

        flashSuccessNotification(__('Successfully cancelled appointment'));

        return to_route('users.appointments.show', [$appointment]);

    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
    }
}
