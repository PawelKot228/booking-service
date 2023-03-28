<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicePromotion extends Model
{
    protected $fillable = [
        'price',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(CompanyPromotion::class);
    }
}
