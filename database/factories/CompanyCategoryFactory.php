<?php

namespace Database\Factories;

use App\Enums\ServiceSubcategory;
use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CompanyCategoryFactory extends Factory
{
    protected $model = CompanyCategory::class;

    public function definition(): array
    {
        $subCategory = collect(ServiceSubcategory::cases())->random(1)->first();
        $category = ServiceSubcategory::getCategory($subCategory);

        return [
            'category' => $category->value,
            'subcategory' => $subCategory->value,
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
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
}
