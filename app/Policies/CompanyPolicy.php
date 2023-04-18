<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return true;
    }

    public function view(): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return (bool)$user->id;
    }

    public function update(User $user, Company $company): bool
    {
        return $user->id === $company->user_id;
    }

    public function delete(User $user, Company $company): bool
    {
        return $user->id === $company->user_id;
    }

    public function restore(User $user, Company $company): bool
    {
        return $user->id === $company->user_id;
    }

    public function forceDelete(User $user, Company $company): bool
    {
        return $user->id === $company->user_id;
    }
}
