<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;

class UserCompanyCategoryController extends Controller
{
    public function index(Company $company)
    {
        return view('pages.users.companies.categories.index', compact('company'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(CompanyCategory $companyCategory)
    {
    }

    public function edit(CompanyCategory $companyCategory)
    {
    }

    public function update(Request $request, CompanyCategory $companyCategory)
    {
    }

    public function destroy(CompanyCategory $companyCategory)
    {
    }
}
