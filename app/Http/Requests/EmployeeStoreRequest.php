<?php

namespace App\Http\Requests;

use App\Enums\EmployeeRole;
use App\Rules\EmployeeExistsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => ['required', Rule::enum(EmployeeRole::class)],
            'email' => ['required', 'email', 'max:254', new EmployeeExistsRule],
        ];
    }
}
