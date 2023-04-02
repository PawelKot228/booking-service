<?php

namespace App\Actions\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;

class GetCompaniesList extends Controller
{
    public function __invoke()
    {
        return Company::limit(10)->get()
            ->map(function (Company $company) {
                $company->url = route('companies.show', ['company' => $company->getKey()]);

                return $company;
            });
    }
}
