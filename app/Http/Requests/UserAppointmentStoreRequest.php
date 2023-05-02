<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAppointmentStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'service_id' => ['required', 'exists:services,id'],
            'from' => ['required', 'date_format:Y-m-d H:i:s'],
        ];
    }
}
