<?php

namespace Database\Seeders;

use App\Enums\EmployeeRole;
use App\Models\Company;
use App\Models\Pivot\CompanyUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    private Collection $users;

    public function __construct()
    {
        $this->users = User::select('id')->get();
    }

    public function run(): void
    {
        $this->createCompanies($this->users->find(1));
        foreach ($this->users->random(200) as $user) {
            $this->createCompanies($user);
        }
    }

    private function createCompanies(User $user): void
    {
        $companies = Company::factory()
            ->count(random_int(1, 3))
            ->create(['user_id' => $user->getKey()]);

        foreach ($companies as $company) {
            $syncUsers[] = [
                'company_id' => $company->getKey(),
                'user_id' => $user->getKey(),
                'type' => EmployeeRole::OWNER,
            ];

            foreach ($this->users->random(random_int(3, 6)) as $randomUser) {
                $syncUsers[] = [
                    'company_id' => $company->getKey(),
                    'user_id' => $randomUser->getKey(),
                    'type' => EmployeeRole::EMPLOYEE,
                ];
            }
        }

        CompanyUser::insert($syncUsers);
    }
}
