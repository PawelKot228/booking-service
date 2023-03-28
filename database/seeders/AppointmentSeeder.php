<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::select('id')->get();
        $companies = Company::with(['services', 'employees'])->get();

        $appointments = [];
        foreach ($companies as $company) {
            foreach ($company->services as $service) {
                $factoryAppointments = Appointment::factory()
                    ->count(random_int(0, 2))
                    ->withCustomer($customers->random()->getKey())
                    ->withEmployee($company->employees->random()->getKey())
                    ->withCompany($company->getKey())
                    ->withService($service->getKey())
                    ->make();

                foreach ($factoryAppointments as $appointment) {
                    $appointments[] = [
                        ...$appointment->toArray(),
                        'created_at' => now()->toDateTime(),
                        'updated_at' => now()->toDateTime(),
                    ];
                }
            }
        }

        foreach (array_chunk($appointments, 250) as $appointmentsChunk) {
            Appointment::insert($appointmentsChunk);
        }
    }
}
