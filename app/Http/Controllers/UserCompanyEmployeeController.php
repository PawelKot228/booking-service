<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;

class UserCompanyEmployeeController extends Controller
{
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
        try {
            $user = User::where('email', $request->email)->firstOrFail();
            $company->employeesPivot()->create([
                'user_id' => $user->getKey(),
                'type' => $request->type,
            ]);

            flashSuccessNotification(__('Successfully created!'));
        } catch (\Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

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
        try {
            $company->employeesPivot()
                ->where('user_id', $user)
                ->update(['type' => $request->type]);

            flashSuccessNotification(__('Successfully created!'));
        } catch (\Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

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
