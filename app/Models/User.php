<?php

namespace App\Models;

use App\Enums\EmployeeRole;
use App\Models\Pivot\CompanyUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function clientAppointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'employee_id');
    }

    public function ownedCompanies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function employerCompany(): HasOneThrough
    {
        return $this->hasOneThrough(
            Company::class,
            CompanyUser::class,
            'company_user.user_id',
            'companies.id',
            'users.id',
            'company_user.company_id'
        );
    }

    public function role(): HasOne
    {
        return $this->hasOne(CompanyUser::class);
    }

    public function getRoleName(): ?string
    {
        return $this?->role?->type;
    }

    public function isEmployee(): bool
    {
        return in_array($this->getRoleName(), [
            EmployeeRole::EMPLOYEE->value,
            EmployeeRole::MANAGER->value,
            EmployeeRole::OWNER->value
        ]);
    }

    public function isManager(): bool
    {
        return in_array($this->getRoleName(), [
            EmployeeRole::MANAGER->value,
            EmployeeRole::OWNER->value
        ]);
    }

    public function isOwner(?Company $company = null): bool
    {
        if ($company?->user_id === $this->id) {
            return true;
        }

        return $this->getRoleName() === EmployeeRole::OWNER->value;
    }

}
