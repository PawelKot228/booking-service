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
            'categoryNames' => str($this->categoryNames ?? '')->explode(',')->filter()->toArray(),
            'subcategoryNames' => str($this->subcategoryNames ?? '')->explode(',')->filter()->toArray(),
        ]);
    }
}
