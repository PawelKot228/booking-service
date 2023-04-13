<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAppointmentStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'service_id' => ['required', 'exists:services'],
            'day' => ['required', 'date'],
            'from' => ['required', 'date_format:H:i'],
        ];
    }

    public function authorize(): bool
    {
        return (bool)auth()->id();
    }
}
