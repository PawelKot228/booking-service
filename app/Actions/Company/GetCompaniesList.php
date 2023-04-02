<?php

namespace App\Actions\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;

class GetCompaniesList extends Controller
{
    public function __invoke()
    {
        return CompanyResource::collection(
            Company::limit(10)->get()
        );
    }
}
