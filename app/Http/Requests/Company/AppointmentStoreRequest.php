<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'email', 'exists:users,email'],
            'employee_id' => ['nullable', 'exists:users,id'],
            'service_id' => ['required', 'exists:services,id'],
            'day' => ['required'],
            'hour' => ['required'],
            //'price' => ['required'],
            //'status' => ['required', 'integer'],
        ];
    }
}
