<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvailableAppointmentsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => ['sometimes', 'date']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'date' => $this->date ?? today()->toDateString(),
        ]);
    }
}
