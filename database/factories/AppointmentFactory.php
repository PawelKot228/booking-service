<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Company;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        $dateFrom = Carbon::parse($this->faker->dateTimeBetween('-3 months', '+3 months'));
        $dateTo = $dateFrom->clone()->addHour();

        $rating = null;
        if (now()->greaterThan($dateTo)) {
            $rating = $this->faker->numberBetween(1, 5);
        }

        return [
            'user_id' => $this->faker->randomNumber(),
            'employee_id' => $this->faker->randomNumber(),
            'from' => $dateFrom,
            'to' => $dateTo,
            'rating' => $rating,
            'price' => $this->faker->numberBetween(1000, 500000) / 100,
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

    public function withEmployee(User|int|null $user): static
    {
        $user ??= User::factory();

        return $this->state(fn(array $attributes) => [
            'employee_id' => $user,
        ]);
    }

    public function withCompany(Company|int|null $company): static
    {
        $company ??= Company::factory();

        return $this->state(fn(array $attributes) => [
            'company_id' => $company,
        ]);
    }

    public function withService(Service|int|null $service): static
    {
        $service ??= Service::factory();

        return $this->state(fn(array $attributes) => [
            'service_id' => $service,
        ]);
    }

}
