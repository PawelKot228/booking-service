<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Pivot\CompanyUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::select('id')->get();
        $syncUsers = [];

        foreach ($users->random(500) as $user) {
            $companies = Company::factory()
                ->count(random_int(1, 3))
                ->create(['user_id' => $user->getKey()]);

            foreach ($companies as $company) {
                foreach ($users->random(random_int(3, 6)) as $randomUser) {
                    $syncUsers[] = [
                        'company_id' => $company->getKey(),
                        'user_id' => $randomUser->getKey()
                    ];
                }
            }
        }

        foreach (array_chunk($syncUsers, 500) as $userChunk) {
            CompanyUser::insert($userChunk);
        }
    }
}
