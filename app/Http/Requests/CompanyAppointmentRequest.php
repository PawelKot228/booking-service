<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyAppointmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
            'employee_id' => ['nullable', 'exists:users'],
            'company_id' => ['required', 'exists:companies'],
            'service_id' => ['required', 'exists:services'],
            'from' => ['required', 'date'],
            'to' => ['required', 'date'],
            'price' => ['required'],
            'status' => ['required', 'integer'],
        ];
    }
}
