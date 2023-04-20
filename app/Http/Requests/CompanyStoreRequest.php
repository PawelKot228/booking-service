<?php

namespace App\Http\Requests;

use App\Enums\Day;
use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:720'],
            'street_name' => ['required', 'max:255'],
            'street_number' => ['required', 'max:64'],
            'apartment_number' => ['nullable', 'numeric', 'digits_between:0,64'],
            'zip_code' => ['nullable', 'max:64'],
            'city' => ['required', 'max:255'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'open_hours.*.open' => [
                'nullable',
                'date_format:H:i',
                'required_with:open_hours.*.close',
                'before:open_hours.*.close',
            ],
            'open_hours.*.close' => [
                'sometimes',
                'nullable',
                'date_format:H:i',
                'required_with:open_hours.*.open',
                'after:open_hours.*.open',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'open_hours.*.open' => __('Time must be before closing'),
            'open_hours.*.close' => __('Time must be after opening'),
        ];
    }
}
