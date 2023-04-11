<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $appointments = Appointment::whereDate('to', '<=', now())->get();

        $reviews = [];
        foreach ($appointments as $appointment) {
            $reviews[] = Review::factory()
                ->withCompany($appointment->company_id)
                ->withCustomer($appointment->user_id)
                ->withAppointment($appointment->id)
                ->make()
                ->toArray();
        }

        foreach (array_chunk($reviews, 250) as $reviewsChunk) {
            Review::insert($reviewsChunk);
        }
    }
}
