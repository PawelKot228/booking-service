<?php

namespace App\Http\Controllers;

use App\Enums\EmployeeRole;
use App\Http\Requests\Company\StoreRequest;
use App\Models\Company;
use App\Models\User;
use App\Services\CompanyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserCompanyController extends Controller
{
    public function __construct(
        private readonly CompanyService $companyService
    ) {
        $this->middleware('company:'.EmployeeRole::EMPLOYEE->value)
            ->only(['index', 'show', 'create', 'store']);
        $this->middleware('company:'.EmployeeRole::MANAGER->value)
            ->except(['index', 'show', 'create', 'store']);
    }

    public function create()
    {
        return view('pages.users.companies.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $company = $this->companyService->save($request->validated(), $user);

        if (!$company) {
            flashErrorNotification(__('Unexpected error occurred'));
            return redirect()->back();
        }

        flashSuccessNotification(__('Successfully created a company!'));

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
