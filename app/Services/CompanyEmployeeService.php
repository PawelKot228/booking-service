<?php

namespace App\Services;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyEmployeeService
{
    public function save(Company $company, Request $request): ?User
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

            return null;
        }

        return $user;
    }

    public function update(Company $company, int $userId, Request $request): bool
    {
        try {
            $company->employeesPivot()
                ->where('user_id', $userId)
                ->update(['type' => $request->type]);
        } catch (\Exception $exception) {
            logError($exception);

            return false;
        }

        return true;
    }
}
