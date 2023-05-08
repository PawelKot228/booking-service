<?php

namespace App\Http\Controllers;

use App\Enums\EmployeeRole;
use App\Http\Requests\Company\StoreRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserCompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('company:' . EmployeeRole::EMPLOYEE->value)
            ->only(['index', 'show']);
        $this->middleware('company:' . EmployeeRole::MANAGER->value)
            ->except(['index', 'show']);
    }

    public function create()
    {
        return view('pages.users.companies.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        try {
            $company = $user->ownedCompanies()->create($request->validated());
            flashSuccessNotification(__('Successfully created a company!'));
        } catch (\Exception $exception) {
            logError($exception);
            flashErrorNotification(__('Unexpected error occurred'));

            return redirect()->back();
        }

        return to_route('users.companies.edit', ['company' => $company->getKey()]);
    }
    public function show(Company $company)
    {
        return view('pages.users.companies.show', compact('company'));
    }

    public function edit(string $id)
    {
        $company = Company::with(['services', 'categories'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('pages.users.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
    }

    public function destroy(Company $company)
    {
    }
}
