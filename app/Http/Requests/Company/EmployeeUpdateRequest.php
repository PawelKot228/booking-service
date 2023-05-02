<?php

namespace App\Http\Requests\Company;

use App\Enums\EmployeeRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => ['required', Rule::enum(EmployeeRole::class)],
        ];
    }
}
