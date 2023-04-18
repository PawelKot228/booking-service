<?php

namespace App\Models;

use App\Models\Pivot\CompanyUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'street_name',
        'street_number',
        'apartment_number',
        'zip_code',
        'city',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'decimal',
        'longitude' => 'decimal',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, CompanyUser::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function promotions(): HasMany
    {
        return $this->hasMany(CompanyPromotion::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(CompanyCategory::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function getFormattedStreet(): string
    {
        $streetNumber = $this->street_number;

        if ($this->apartament_number) {
            $streetNumber .= "/$this->apartament_number";
        }

        return "$this->street_name $streetNumber";
    }
}
