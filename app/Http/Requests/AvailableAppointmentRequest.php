<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvailableAppointmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => ['sometimes', 'date']
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'date' => $this->date ?? today()->toDateString(),
        ]);
    }
}
