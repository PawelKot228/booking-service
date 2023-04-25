<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CompanyEmployeeTable extends DataTableComponent
{
    public int $companyId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return User::query()
            ->groupBy('users.id')
            ->join('company_user', function (JoinClause $joinClause) {
                $joinClause->on('company_user.user_id', '=', 'users.id');
                $joinClause->where('company_user.company_id', $this->companyId);
            });
    }

    public function columns(): array
    {
        return [
            Column::make(__('Actions'), 'id')
            ->format(fn (int $id) => view('components.datatable.actions')
                ->with('actions', [
                    'edit' => route(
                        'users.companies.employees.edit',
                        ['company' => $this->companyId, 'employee' => $id]
                    ),
                    'delete' => route(
                        'users.companies.employees.destroy',
                        ['company' => $this->companyId, 'employee' => $id]
                    )
                ])
            ),
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Email'), 'email')
                ->searchable()
                ->sortable(),
            Column::make(__('Created at'), 'created_at')
                ->sortable(),
        ];
    }
}