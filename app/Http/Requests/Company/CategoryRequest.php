<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            //'company_id' => ['required', 'exists:companies,id'],
            'category' => ['required'],
            'subcategory' => ['required'],
            'name' => ['required'],
            'description' => ['sometimes', 'nullable'],
        ];
    }
}
