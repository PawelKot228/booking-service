<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Review */
class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'rating' => $this->rating,
            'user' => $this->whenLoaded('user'),
            'created_at' => $this->created_at->format('H:i d/m/y'),
        ];
    }
}
