<?php

namespace Database\Factories;

use App\Enums\ServiceSubcategory;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(10, 500),
            'created_at' => now()->toDateTime(),
            'updated_at' => now()->toDateTime(),
        ];
    }

    public function withCompany(Company|int|null $company): static
    {
        $company ??= Company::factory();

        return $this->state(fn(array $attributes) => [
            'company_id' => $company,
        ]);
    }

    public function withCategory(CompanyCategory|int|null $companyCategory): static
    {
        $companyCategory ??= Company::factory();

        return $this->state(fn(array $attributes) => [
            'company_category_id' => $companyCategory,
        ]);
    }
}
