<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'price' => ['required', 'numeric'],
            'duration' => ['required', 'integer'],
            'currency' => ['required'],
        ];
    }
}
