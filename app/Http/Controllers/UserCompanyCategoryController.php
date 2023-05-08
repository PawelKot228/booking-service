<?php

namespace App\Http\Controllers;

use App\Enums\EmployeeRole;
use App\Http\Requests\Company\CategoryRequest;
use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Http\RedirectResponse;

class UserCompanyCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('company:' . EmployeeRole::EMPLOYEE->value)
            ->only(['index', 'show']);
        $this->middleware('company:' . EmployeeRole::MANAGER->value)
            ->except(['index', 'show']);
    }

    public function index(Company $company)
    {
        return view('pages.users.companies.categories.index', compact('company'));
    }

    public function create(Company $company)
    {
        return view('pages.users.companies.categories.create', compact('company'));
    }

    public function store(CategoryRequest $request, Company $company): RedirectResponse
    {
        try {
            $companyCategory = $company->categories()->create($request->validated());
            flashSuccessNotification(__('Successfully created a category'));
        } catch (\Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

        return to_route('users.companies.categories.edit', [$company, $companyCategory]);
    }

    public function show(CompanyCategory $companyCategory)
    {
    }

    public function edit(Company $company, $companyCategory)
    {
        $companyCategory = CompanyCategory::findOrFail($companyCategory);

        return view('pages.users.companies.categories.edit', compact('company', 'companyCategory'));
    }

    public function update(CategoryRequest $request, Company $company, $companyCategory): RedirectResponse
    {
        try {
            $companyCategory = $company->categories()->findOrFail($companyCategory);
            $companyCategory->fill(
                $request->validated()
            )->save();

            flashSuccessNotification(__('Successfully updated!'));
        } catch (\Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

        return to_route('users.companies.categories.edit', [$company, $companyCategory]);
    }

    public function destroy(Company $company, $companyCategory): RedirectResponse
    {
        try {
            $companyCategory = CompanyCategory::findOrFail($companyCategory);
            $companyCategory->delete();
        } catch (\Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

        return to_route('users.companies.categories.index', [$company]);
    }
}
