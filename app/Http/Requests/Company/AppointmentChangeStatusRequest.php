<?php

namespace App\Http\Requests\Company;

use App\Enums\AppointmentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppointmentChangeStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(AppointmentStatus::class)],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => (int)$this->status,
        ]);
    }
}
