<?php

namespace App\Http\Controllers;

use App\Actions\Company\FetchCompaniesList;
use App\Http\Requests\Company\SearchRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{
    public function index(SearchRequest $request, FetchCompaniesList $companiesQuery): AnonymousResourceCollection
    {
        $companies = $companiesQuery->handle(Company::with(['categories']), $request)->get();

        return CompanyResource::collection($companies);
    }

    public function show(string $id)
    {
        $company = Company::with([
            'categories' => ['services']
        ])->findOrFail($id);

        return view('pages.companies.show', compact('company'));
    }
}
