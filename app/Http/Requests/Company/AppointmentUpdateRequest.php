<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'employee_id' => ['nullable', 'exists:users,id'],
            'day' => ['required'],
            'hour' => ['required'],
        ];
    }

}
