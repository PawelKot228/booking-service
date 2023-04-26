<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserCompanyController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('pages.users.companies.create');
    }

    public function store(CompanyStoreRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        try {
            $company = $user->ownedCompanies()->create($request->validated());
            flashSuccessNotification(__('Successfully created a company!'));
        } catch (\Exception $exception) {
            \Log::error("{$exception->getMessage()} - {$exception->getFile()}@{$exception->getLine()}");
            flashErrorNotification(__('Could not create a company'));

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
