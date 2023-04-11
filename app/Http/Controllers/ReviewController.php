<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Models\Company;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReviewController extends Controller
{
    public function index($company): AnonymousResourceCollection
    {
        $reviews = Review::with('user')
        ->where('company_id', $company)
            ->get();

        return ReviewResource::collection($reviews);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Review $review)
    {
    }

    public function edit(Review $review)
    {
    }

    public function update(Request $request, Review $review)
    {
    }

    public function destroy(Review $review)
    {
    }
}
