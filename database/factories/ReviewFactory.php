<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'title' => $this->faker->word(),
            'rating' => $this->faker->randomNumber(),
        ];
    }
}
