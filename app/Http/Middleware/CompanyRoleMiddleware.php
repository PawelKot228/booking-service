<?php

namespace App\Http\Middleware;

use App\Enums\EmployeeRole;
use App\Models\Company;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CompanyRoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        /** @var User $user */
        $user = auth()->user();
        $company = $request->company;
        if (!$company instanceof Company) {
            $company = Company::find($company);
        }

        if ((!$role || $role === EmployeeRole::OWNER->value) && $user->isOwner($company)) {
            return $next($request);
        }

        if ($role === EmployeeRole::MANAGER->value && $user->isManager()) {
            return $next($request);
        }

        if ($role === EmployeeRole::EMPLOYEE->value && $user->isEmployee()) {
            return $next($request);
        }

        abort(403);
    }
}
