<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyUser extends Pivot
{
    protected $fillable = [
        'contractor_id',
        'user_id',
        'type',
    ];
}
