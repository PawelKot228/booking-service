<?php

namespace App\Models;

use App\Enums\AppointmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'company_id',
        'service_id',
        'user_id',
        'from',
        'to',
        'status',
        'price',
        'currency',
    ];

    protected $casts = [
        'from' => 'datetime',
        'to' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function isCancelled(): bool
    {
        return $this->status === AppointmentStatus::CANCELLED->value;
    }

    public function isRejected(): bool
    {
        return $this->status === AppointmentStatus::REJECTED->value;
    }

    public function isPending(): bool
    {
        return $this->status === AppointmentStatus::PENDING->value;
    }

    public function isAccepted(): bool
    {
        return $this->status === AppointmentStatus::ACCEPTED->value;
    }

    public function isFinished(): bool
    {
        return $this->status === AppointmentStatus::FINISHED->value;
    }
}
