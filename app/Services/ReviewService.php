<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ReviewService
{
    public function companyReviewsQuery(Builder $query, int $companyId): Builder|QueryBuilder
    {
        return $query
            ->where('company_id', $companyId)
            ->orderByDesc('created_at');
    }


    /**
     * @throws ModelNotFoundException
     */
    public function findReview(int $id, int $appointmentId, ?int $userId = null): Review
    {
        $userId ??= auth()->id();

        return Review::query()
            ->where('user_id', $userId)
            ->where('appointment_id', $appointmentId)
            ->findOrFail($id);
    }

    public function save(Appointment $appointment, Request $request): ?Appointment
    {
        try {
            $review = $appointment->review()->make($request->validated());
            $review->user_id = $appointment->user_id;
            $review->company_id = $appointment->company_id;
            $review->save();

        } catch (\Exception $exception) {
            logError($exception);

            return null;
        }

        return $appointment;
    }

    public function update(Review $review, Request $request): bool
    {
        try {
            return $review->fill($request->validated())->save();
        } catch (\Exception $exception) {
            logError($exception);
            return false;
        }
    }

    public function delete(Review $review): ?bool
    {
        try {
            return $review->delete();
        } catch (\Exception $exception) {
            logError($exception);
            return false;
        }
    }
}
