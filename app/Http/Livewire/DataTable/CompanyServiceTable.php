<?php

namespace App\Http\Livewire\DataTable;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CompanyServiceTable extends DataTableComponent
{
    use HasTooltips;

    public int $companyId;
    public int $companyCategoryId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Service::query()
            ->where('company_category_id', $this->companyCategoryId)
            ->join('company_categories', function (JoinClause $join) {
                $join->on('services.company_category_id', '=', 'company_categories.id');
                $join->where('company_categories.company_id', $this->companyId);
            })
            ->groupBy('services.id');
    }

    public function columns(): array
    {
        $actionsColumn = Column::make(__('Actions'), 'id')
            ->format(fn(int $id) => view('components.datatable.actions')
                ->with('actions', [
                    'edit' => route(
                        'users.companies.categories.services.edit',
                        ['company' => $this->companyId, 'category' => $this->companyCategoryId, 'service' => $id]
                    ),
                    'delete' => route(
                        'users.companies.categories.services.destroy',
                        ['company' => $this->companyId, 'category' => $this->companyCategoryId, 'service' => $id]
                    ),
                ])
            );


        return [
            ...auth()->user()?->isManager() ? [$actionsColumn] : [],

            Column::make("Name", "name")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("Price", "price")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
        ];
    }
}
