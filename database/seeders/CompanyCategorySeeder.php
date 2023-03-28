<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CompanyCategorySeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::select('id')->get();

        $categories = [];
        foreach ($companies as $company) {
            $categoriesCount = random_int(2, 3);

            for ($i = 0; $i < $categoriesCount; $i++) {
                $categories[] = [
                    ...CompanyCategory::factory()->withCompany($company)->make()->toArray(),
                    'created_at' => now()->toDateTime(),
                    'updated_at' => now()->toDateTime(),
                ];
            }
        }

        foreach (array_chunk($categories, 500) as $categoriesChunk) {
            CompanyCategory::insert($categoriesChunk);
        }
    }
}
