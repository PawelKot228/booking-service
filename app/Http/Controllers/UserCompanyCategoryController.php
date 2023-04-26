<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCategoryRequest;
use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;

class UserCompanyCategoryController extends Controller
{
    public function index(Company $company)
    {
        return view('pages.users.companies.categories.index', compact('company'));
    }

    public function create(Company $company)
    {
        return view('pages.users.companies.categories.create', compact('company'));
    }

    public function store(CompanyCategoryRequest $request, Company $company)
    {
        try {
            $category = $company->categories()->create($request->validated());
            flashSuccessNotification(__('Successfully created a category'));
        } catch (\Exception $exception) {
            \Log::error("{$exception->getMessage()} - {$exception->getFile()}@{$exception->getLine()}");
            flashErrorNotification(__('Could not create a category'));

            return redirect()->back();
        }

        return to_route('users.companies.categories.edit', [$company, $category]);
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
