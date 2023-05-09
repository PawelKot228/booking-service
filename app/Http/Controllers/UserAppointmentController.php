<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatus;
use App\Http\Requests\UserAppointmentStoreRequest;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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

        $service = Service::with(['category'])->findOrFail($request->service_id);

        $from = Carbon::parse($request->from);

        $appointment = $user->appointments()->create([
            ...$request->toArray(),
            'company_id' => $service->category->company_id,
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

        try {
            $appointment->update(['status' => AppointmentStatus::CANCELLED->value]);

            flashSuccessNotification(__('Successfully cancelled appointment'));
        } catch (\Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

        return to_route('users.appointments.show', [$appointment]);

    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
    }
}
