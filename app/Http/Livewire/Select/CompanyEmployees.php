<?php

namespace App\Http\Livewire\Select;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class CompanyEmployees extends Component
{
    public int $companyId;
    public null|int|string $appointmentEmployeeId;

    public function render()
    {
        $employees = User::whereHas(
            'employerCompany',
            fn(Builder $query) => $query->where('companies.id', $this->companyId)
        )->get();

        return view('livewire.select.company-employees', compact('employees'));
    }
}
