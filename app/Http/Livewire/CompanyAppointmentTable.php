<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Appointment;

class CompanyAppointmentTable extends DataTableComponent
{
    protected $model = Appointment::class;
    public string $companyId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Appointment::where('company_id', $this->companyId);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Company id", "company_id")
                ->sortable(),
            Column::make("Service id", "service_id")
                ->sortable(),
            Column::make("From", "from")
                ->sortable(),
            Column::make("To", "to")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Price", "price")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
