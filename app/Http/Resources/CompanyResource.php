<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Company */
class CompanyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $categories = [];
        $subcategories = [];

        if ($this->whenLoaded('categories')) {
            foreach ($this->categories as $category) {
                $categories[] = __($category->category);
                $subcategories[] = __($category->subcategory);
            }
        }


        return [
            'id' => $this->id,
            'url' => route('companies.show', ['company' => $this->id]),
            'name' => $this->name,
            'tags' => [
                'categories' => $categories,
                'subcategories' => $subcategories,
            ],
            'reviews' => [
                'url' => route('companies.reviews.index', ['company' => $this->id]),
                'count' => 5,
                'avg_rating' => number_format((float)$this->appointments_avg_rating, 2),
            ],
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            //'user_id' => $this->user_id,
        ];
    }
}
