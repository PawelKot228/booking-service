<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $companyCategories = CompanyCategory::select(['id', 'company_id'])->get();

        $services = [];
        foreach ($companyCategories as $companyCategory) {
            $serviceModels = Service::factory()
                ->withCompany($companyCategory->company_id)
                ->withCategory($companyCategory->getKey())
                ->count(random_int(2, 5))
                ->make();

            foreach ($serviceModels as $serviceModel) {
                $services[] = [
                    ...$serviceModel->toArray(),
                    'created_at' => now()->toDateTime(),
                    'updated_at' => now()->toDateTime(),
                ];
            }
        }

        foreach (array_chunk($services, 250) as $serviceChunk) {
            Service::insert($serviceChunk);
        }
    }
}
