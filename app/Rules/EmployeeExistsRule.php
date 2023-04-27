<?php

namespace App\Rules;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmployeeExistsRule implements ValidationRule
{


    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /** @var int|Company $company */
        $company = request('company');

        if ($company instanceof Company) {
            $company = $company->id;
        }

        $employeeExists = Company::where('companies.id', $company)
            ->join('company_user', 'companies.id', '=', 'company_user.company_id')
            ->join('users', 'company_user.user_id', '=', 'users.id')
            //->where('users.email', $value)
            ->exists();

        if ($employeeExists) {
            $fail('The :attribute is already an employee.');
        }
    }
}
