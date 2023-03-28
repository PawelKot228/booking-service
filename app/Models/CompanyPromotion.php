<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyPromotion extends Model
{
    protected $fillable = [
        'name',
        'description',
        'from',
        'to',
    ];

    public function servicePromotion(): HasMany
    {
        return $this->hasMany(ServicePromotion::class);
    }
}
