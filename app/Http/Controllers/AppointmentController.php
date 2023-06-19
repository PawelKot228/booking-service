<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvailableAppointmentRequest;
use App\Http\Resources\ScheduleAppointmentResource;
use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function availableList(AvailableAppointmentRequest $request, $company, $service): JsonResponse
    {
        $date = Carbon::parse($request->date);

        $service = Service::with([
            'company',
            'appointments' => fn(HasMany $query) => $query->where(
                fn(Builder $query) => $query
                    ->whereDate('from', '>=', $date->startOfDay())
                    ->whereDate('to', '<=', $date->endOfDay())
            ),
        ])
        ->has('company')
        ->findOrFail($service);

        return response()->json((new ScheduleAppointmentResource($service)));
    }

    public function index($company, $service)
    {
    }

    public function create()
    {
    }

    public function store(Request $request, $company, $service)
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
