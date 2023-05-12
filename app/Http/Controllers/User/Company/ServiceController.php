<?php

namespace App\Http\Controllers\User\Company;

use App\Enums\EmployeeRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\ServiceRequest;
use App\Models\Company;
use App\Models\Service;
use App\Services\ServiceService;
use Exception;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    public function __construct(
        private readonly ServiceService $serviceService
    ) {
        $this->middleware('company:'.EmployeeRole::EMPLOYEE->value)
            ->only(['index', 'show']);
        $this->middleware('company:'.EmployeeRole::MANAGER->value)
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

        $service = $this->serviceService->save($companyCategory, $request);

        if (!$service) {
            flashSuccessNotification(__('Unexpected error occurred'));
            return redirect()->back();
        }

        flashSuccessNotification(__('Successfully created!'));

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
        $companyCategory = $company->categories()->findOrFail($companyCategory);
        $service = $companyCategory->services()->findOrFail($service);

        if (!$this->serviceService->update($service, $request)) {
            flashSuccessNotification(__('Unexpected error occurred'));
            return redirect()->back();
        }

        flashSuccessNotification(__('Successfully created!'));

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
