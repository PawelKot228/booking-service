<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;

class CompanyCategoryService
{
    public function save(Company $company, Request $request): ?CompanyCategory
    {
        try {
            $companyCategory = $company->categories()->create($request->validated());
        } catch (\Exception $exception) {
            logError($exception);

            return null;
        }

        return $companyCategory;
    }

    public function update(CompanyCategory $companyCategory, Request $request): bool
    {
        try {
            return $companyCategory->fill($request->validated())->save();
        } catch (\Exception $exception) {
            logError($exception);

            return false;
        }
    }
}
