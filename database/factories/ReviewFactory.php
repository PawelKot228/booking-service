<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Company;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'company_id' => $this->faker->randomNumber(),
            'appointment_id' => $this->faker->randomNumber(),
            'title' => $this->faker->word(),
            'text' => $this->faker->text(),
            'rating' => $this->faker->numberBetween(1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function withCustomer(User|int|null $user): static
    {
        $user ??= User::factory();

        return $this->state(fn(array $attributes) => [
            'user_id' => $user,
        ]);
    }
    public function withCompany(Company|int|null $company): static
    {
        $company ??= Company::factory();

        return $this->state(fn(array $attributes) => [
            'company_id' => $company,
        ]);
    }
    public function withAppointment(Appointment|int|null $appointment): static
    {
        $appointment ??= Appointment::factory();

        return $this->state(fn(array $attributes) => [
            'appointment_id' => $appointment,
        ]);
    }
}
