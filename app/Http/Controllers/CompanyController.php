<?php

namespace App\Http\Controllers;

use App\Actions\Company\FetchCompaniesList;
use App\Http\Requests\CompanySearchRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{
    public function index(CompanySearchRequest $request, FetchCompaniesList $companiesQuery): AnonymousResourceCollection
    {
        $companies = $companiesQuery->handle(Company::with(['categories']), $request)->get();

        return CompanyResource::collection($companies);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $company = Company::findOrFail($id);

        return view('pages.companies.show', compact('company'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
