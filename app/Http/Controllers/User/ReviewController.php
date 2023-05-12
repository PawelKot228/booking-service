<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Appointment;
use App\Models\Review;
use App\Services\AppointmentService;
use App\Services\ReviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(
        private readonly AppointmentService $appointmentService,
        private readonly ReviewService $reviewService
    ) {
    }

    public function index()
    {
        return view('pages.users.appointments.reviews.index');
    }

    public function create($appointment)
    {
        $appointment = $this->appointmentService->findAppointment((int) $appointment, auth()->id());

        return view('pages.users.appointments.reviews.create', compact('appointment'));
    }

    public function store(ReviewRequest $request, $appointment): RedirectResponse
    {
        $appointment = $this->appointmentService->findAppointment((int) $appointment, auth()->id());
        $review = $this->reviewService->save($appointment, $request);

        if (!$review) {
            flashErrorNotification(__('Unexpected error occurred'));
            return redirect()->back();
        }

        flashSuccessNotification(__('Successfully created a review!'));

        return to_route('users.appointments.reviews.edit', [$appointment->id, $review->id]);
    }

    public function edit($appointment, $review)
    {
        $appointment = $this->appointmentService->findAppointment((int) $appointment, auth()->id());
        $review = $this->reviewService->findReview((int) $review, $appointment->id, auth()->id());

        return view('pages.users.appointments.reviews.edit', compact('appointment', 'review'));
    }

    public function update(ReviewRequest $request, $appointment, $review): RedirectResponse
    {
        $appointment = $this->appointmentService->findAppointment((int) $appointment, auth()->id());
        $review = $this->reviewService->findReview((int) $review, $appointment->id, auth()->id());

        if (!$this->reviewService->update($review, $request)) {
            flashErrorNotification(__('Unexpected error occurred'));
            return redirect()->back();
        }

        flashSuccessNotification(__('Successfully updated a review!'));

        return to_route('users.appointments.reviews.edit', [$appointment->id, $review->id]);
    }

    public function destroy($appointment, $review): RedirectResponse
    {
        $appointment = $this->appointmentService->findAppointment((int) $appointment, auth()->id());
        $review = $this->reviewService->findReview((int) $review, $appointment->id, auth()->id());

        if (!$this->reviewService->delete($review)) {
            flashErrorNotification(__('Unexpected error occurred'));
            return redirect()->back();
        }

        flashSuccessNotification(__('Successfully deleted a review!'));

        return to_route('users.reviews.index');

    }
}
