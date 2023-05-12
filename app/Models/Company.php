<?php

namespace App\Models;

use App\Enums\ImageType;
use App\Models\Pivot\CompanyUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
        'open_hours',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'open_hours' => 'array',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, CompanyUser::class);
    }

    public function employeesPivot(): HasMany
    {
        return $this->hasMany(CompanyUser::class);
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

    public function services(): HasManyThrough
    {
        return $this->hasManyThrough(Service::class, CompanyCategory::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function covers(): MorphMany
    {
        return $this->images()->where('type', ImageType::COVER->value);
    }

    public function gallery(): MorphMany
    {
        return $this->images()->where('type', ImageType::DEFAULT->value);
    }
}
