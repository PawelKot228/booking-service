<?php

namespace App\Http\Livewire\Company;

use App\Models\Review;
use App\Services\ReviewService;
use Livewire\Component;
use Livewire\WithPagination;

class ReviewsSection extends Component
{
    use WithPagination;

    public int|string $companyId;
    public bool $isLoading = true;

    public function render(ReviewService $reviewService)
    {
        $reviews = $reviewService->companyReviewsQuery(
            query: Review::with(['user', 'appointment']),
            companyId: $this->companyId,
        );

        $reviews = $reviews->paginate(5);

        return view('livewire.company.reviews-section', compact('reviews'));
    }
}
