<?php

namespace App\Http\Livewire\Company;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Livewire\Component;

class FeaturedList extends Component
{
    public function render(CompanyService $companyService)
    {
        $companies = $companyService->listQuery(Company::with(['categories']), new Request(['orderBy' => 'best']));

        $companies = $companies
            ->limit(8)
            ->get();

        return view('livewire.company.featured-list', compact('companies'));
    }
}
