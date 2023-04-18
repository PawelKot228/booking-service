<?php

namespace App\Http\Controllers;

use App\Actions\Company\FetchCompaniesList;
use App\Http\Requests\CompanySearchRequest;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{
    public function index(CompanySearchRequest $request, FetchCompaniesList $companiesQuery): AnonymousResourceCollection
    {
        $companies = $companiesQuery->handle(Company::with(['categories']), $request)->get();

        return CompanyResource::collection($companies);
    }

    public function create()
    {
        return view('pages.companies.create');
    }

    public function store(CompanyStoreRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        try {
            $company = $user->ownedCompany()->create($request->validated());
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage() . ' ' . $exception->getFile() . '@' . $exception->getLine());
            return redirect()
                ->back()
                ->withErrors(__('Could not create a company'));
        }

        return to_route('companies.show', ['company' => $company->getKey()])
            ->with('success', [__('Successfully created a company!')]);
    }

    public function show(string $id)
    {
        $company = Company::with([
            'categories' => ['services']
        ])->findOrFail($id);

        return view('pages.companies.show', compact('company'));
    }

    public function edit(string $id)
    {
        $company = Company::with(['services', 'categories'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('pages.companies.edit', compact('company'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
