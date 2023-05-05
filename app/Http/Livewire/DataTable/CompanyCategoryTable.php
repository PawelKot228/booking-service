<?php

namespace App\Http\Livewire\DataTable;

use App\Models\CompanyCategory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CompanyCategoryTable extends DataTableComponent
{
    use HasTooltips;

    public int $companyId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

    }

    public function builder(): Builder
    {
        return CompanyCategory::query()
            ->where('company_id', $this->companyId);
    }

    public function columns(): array
    {
        return [
            Column::make(__('Actions'), 'id')
                ->format(fn (int $id) => view('components.datatable.actions')
                    ->with('actions', [
                        'edit' => route(
                            'users.companies.categories.edit',
                            ['company' => $this->companyId, 'category' => $id]
                        ),
                        'services' => [
                            'tooltip' => 'services',
                            'icon' => 'carousel',
                            'url' => route(
                                'users.companies.categories.services.index',
                                ['company' => $this->companyId, 'category' => $id]
                            )
                        ],
                        'delete' => route(
                            'users.companies.categories.destroy',
                            ['company' => $this->companyId, 'category' => $id]
                        ),
                    ])
                ),

            Column::make("Name", "name")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
        ];
    }
}
