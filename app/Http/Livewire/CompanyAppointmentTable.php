<?php

namespace App\Http\Livewire;

use App\Enums\AppointmentStatus;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Appointment;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class CompanyAppointmentTable extends DataTableComponent
{
    public int $companyId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFilterLayout('slide-down');
    }

    public function builder(): Builder
    {
        return Appointment::where('company_id', $this->companyId);
    }

    public function filters(): array
    {
        $statuses = [];
        foreach (AppointmentStatus::cases() as $appointmentStatus) {
            $statuses["$appointmentStatus->value "] = __($appointmentStatus->name);
        }

        return [
            SelectFilter::make('Active')
                ->options([
                    '' => __('All'),
                    ...$statuses
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('status', $value);
                }),
            //SelectFilter::make('Service id')
            //    ->options([
            //        '' => __('All'),
            //        ...Service::select(['services.id', 'services.name'])
            //            ->join('company_categories', 'services.company_category_id', '=', 'company_categories.id')
            //            ->where('company_categories.company_id', $this->companyId)
            //            ->groupBy('services.id')
            //            ->get()
            //            ->mapWithKeys(fn(Service $service) => ["$service->id " => $service->name])
            //            ->toArray()
            //    ])
            //    ->filter(function (Builder $builder, string $value) {
            //        $builder->where('status', $value);
            //    }),
            DateFilter::make('from')
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereDate('from', '>=', $value);
                }),
            DateFilter::make('to')
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereDate('to', '<=', $value);
                }),
        ];
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
