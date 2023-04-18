<?php

namespace App\Http\Requests;

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
        ];
    }
}
