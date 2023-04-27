<?php

namespace App\Http\Requests;

use App\Enums\EmployeeRole;
use App\Rules\EmployeeExistsRule;
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
