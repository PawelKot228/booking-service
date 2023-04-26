<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyServiceRequest;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserCompanyServiceController extends Controller
{
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

    public function store(CompanyServiceRequest $request, Company $company, $companyCategory): RedirectResponse
    {
        $companyCategory = $company->categories()->findOrFail($companyCategory);

        try {
            $service = $companyCategory->services()->make($request->validated());
            $service->company_id = $company->id;
            $service->save();

            flashSuccessNotification(__('Successfully created!'));
        } catch (\Exception $exception) {
            logError($exception);
            flashSuccessNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

        return to_route('companies.services.appointments.edit', [$company, $companyCategory, $service]);
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

    public function update(CompanyServiceRequest $request, Company $company, $companyCategory, $service)
    {
    }

    public function destroy(Company $company, $companyCategory, $service)
    {
    }
}
