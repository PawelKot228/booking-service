<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanySearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'categoryNames' => ['present', 'array'],
            'subcategoryNames' => ['present', 'array'],
            'lat' => ['present'],
            'lng' => ['present'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'categoryNames' => json_decode(base64_decode($this->categoryNames), true, 512, JSON_THROW_ON_ERROR),
            'subcategoryNames' => json_decode(base64_decode($this->subcategoryNames), true, 512, JSON_THROW_ON_ERROR),
        ]);
    }
}
