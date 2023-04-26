<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserCompanyEmployeeController extends Controller
{
    public function index(Company $company)
    {
        return view('pages.users.companies.employees.index', compact('company'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(User $user)
    {
    }

    public function edit(User $user)
    {
    }

    public function update(Request $request, User $user)
    {
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
