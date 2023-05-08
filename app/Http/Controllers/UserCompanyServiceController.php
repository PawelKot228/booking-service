<?php

namespace App\Http\Controllers;

use App\Enums\EmployeeRole;
use App\Http\Requests\Company\ServiceRequest;
use App\Models\Company;
use App\Models\Service;
use Exception;
use Illuminate\Http\RedirectResponse;

class UserCompanyServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('company:' . EmployeeRole::EMPLOYEE->value)
            ->only(['index', 'show']);
        $this->middleware('company:' . EmployeeRole::MANAGER->value)
            ->except(['index', 'show']);
    }

    public function index(Company $company, $companyCategory)
    {
        $companyCategory = $company->categories()->findOrFail($companyCategory);

        return view('pages.users.companies.services.index', compact('company', 'companyCategory'));
    }

    public function create(Company $company, $companyCategory)
    {
        $companyCategory = $company->categories()->findOrFail($companyCategory);

        return view('pages.users.companies.services.create', compact('company', 'companyCategory'));
    }

    public function store(ServiceRequest $request, Company $company, $companyCategory): RedirectResponse
    {
        $companyCategory = $company->categories()->findOrFail($companyCategory);

        try {
            $service = $companyCategory->services()->create($request->validated());

            flashSuccessNotification(__('Successfully created!'));
        } catch (Exception $exception) {
            logError($exception);
            flashSuccessNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

        return to_route('users.companies.categories.services.edit', [$company, $companyCategory, $service]);
    }

    public function show(Service $service)
    {
    }

    public function edit(Company $company, $companyCategory, $service)
    {
        $companyCategory = $company->categories()->findOrFail($companyCategory);
        $service = $companyCategory->services()->findOrFail($service);

        return view('pages.users.companies.services.edit', compact('company', 'companyCategory', 'service'));
    }

    public function update(ServiceRequest $request, Company $company, $companyCategory, $service): RedirectResponse
    {
        try {
            $companyCategory = $company->categories()->findOrFail($companyCategory);
            $service = $companyCategory->services()->findOrFail($service);

            $service->fill(
                $request->validated()
            )->save();

            flashSuccessNotification(__('Successfully created!'));
        } catch (Exception $exception) {
            logError($exception);
            flashSuccessNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

        return to_route('users.companies.categories.services.edit', [$company, $companyCategory, $service]);
    }

    public function destroy(Company $company, $companyCategory, $service): RedirectResponse
    {
        try {
            $companyCategory = $company->categories()->findOrFail($companyCategory);
            $service = $companyCategory->services()->findOrFail($service);

            $service->delete();

            flashSuccessNotification(__('Successfully created!'));
        } catch (Exception $exception) {
            logError($exception);
            flashSuccessNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

        return to_route('users.companies.categories.services.index', [$company, $companyCategory]);
    }
}
