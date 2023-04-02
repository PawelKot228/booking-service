<?php

namespace App\Actions\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Appointment;
use App\Models\Company;

class GetCompaniesList extends Controller
{
    public function __invoke()
    {
        $companies = Company::with(['categories'])
            ->withAvg('appointments', 'rating')
            ->limit(10)
            ->get();

        return CompanyResource::collection($companies);
    }
}
