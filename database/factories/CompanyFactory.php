<?php

namespace Database\Factories;

use App\Enums\Day;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        $openingHours = [];
        foreach (Day::cases() as $day) {
            $openingHours[$day->name]['open'] = '08:00';
            $openingHours[$day->name]['close'] = '18:00';
        }

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'street_name' => $this->faker->streetName(),
            'street_number' => $this->faker->buildingNumber(),
            'apartment_number' => $this->faker->optional()->buildingNumber(),
            'zip_code' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'open_hours' => $openingHours,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

}
