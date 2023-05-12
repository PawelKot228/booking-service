<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:250'],
            'text' => ['nullable'],
            'rating' => ['required', 'integer'],
        ];
    }
}
