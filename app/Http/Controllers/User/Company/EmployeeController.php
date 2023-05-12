<?php

namespace App\Http\Controllers\User\Company;

use App\Enums\EmployeeRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\EmployeeStoreRequest;
use App\Http\Requests\Company\EmployeeUpdateRequest;
use App\Models\Company;
use App\Models\User;
use App\Services\CompanyEmployeeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    public function __construct(
        private readonly CompanyEmployeeService $employeeService
    ) {
        $this->middleware('company:'.EmployeeRole::EMPLOYEE->value)
            ->only(['index', 'show']);
        $this->middleware('company:'.EmployeeRole::MANAGER->value)
            ->except(['index', 'show']);
    }

    public function index(Company $company)
    {
        return view('pages.users.companies.employees.index', compact('company'));
    }

    public function create(Company $company)
    {
        return view('pages.users.companies.employees.create', compact('company'));
    }

    public function store(EmployeeStoreRequest $request, Company $company): RedirectResponse
    {
        $user = $this->employeeService->save($company, $request);

        if (!$user) {
            flashErrorNotification(__('Unexpected error occurred'));
            return redirect()->back();
        }

        flashSuccessNotification(__('Successfully created!'));

        return to_route('users.companies.employees.edit', [$company, $user]);
    }

    public function show(User $user)
    {
    }

    public function edit(Company $company, $user)
    {
        $user = $company->employees()->with('role')->findOrFail($user);

        return view('pages.users.companies.employees.edit', compact('company', 'user'));
    }

    public function update(EmployeeUpdateRequest $request, Company $company, $user): RedirectResponse
    {
        if (!$this->employeeService->update($company, $user, $request)) {
            flashErrorNotification(__('Unexpected error occurred'));
            return redirect()->back();
        }

        flashSuccessNotification(__('Successfully created!'));

        return to_route('users.companies.employees.edit', [$company, $user]);
    }

    public function destroy(Company $company, $userId): RedirectResponse
    {
        try {
            $user = User::findOrFail($userId);
            $company->employees()->detach($user->getKey());

            flashSuccessNotification(__('Successfully deleted!'));
        } catch (ModelNotFoundException $exception) {
            flashErrorNotification(__("Could not find user"));
        } catch (\Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));
        }

        return to_route('users.companies.employees.index', [$company]);
    }
}
