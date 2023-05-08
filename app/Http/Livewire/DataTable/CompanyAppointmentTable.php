<?php

namespace App\Http\Livewire\DataTable;

use App\Enums\AppointmentStatus;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class CompanyAppointmentTable extends DataTableComponent
{
    use HasTooltips;

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
            Column::make(__('Actions'), 'id')
                ->format(fn(int $id) => view('components.datatable.actions')
                    ->with('actions', [
                        'show' => route(
                            'users.companies.appointments.show',
                            ['company' => $this->companyId, 'appointment' => $id]
                        ),
                        ...auth()->user()->isManager() ? [
                            'edit' => route(
                                'users.companies.appointments.edit',
                                ['company' => $this->companyId, 'appointment' => $id]
                            ),
                        ] : [],
                    ])
                ),

            Column::make(__('Customer'), "customer.name")
                ->sortable(),
            Column::make(__('Service'), "service.name")
                ->sortable(),
            Column::make(__('Day'), "from")
                ->format(fn(Carbon $from) => $from->isoFormat('D MMMM YYYY'))
                ->sortable(),
            Column::make(__('From'), "from")
                ->format(fn(Carbon $from) => $from->format('H:i'))
                ->sortable(),
            Column::make(__('To'), "to")
                ->format(fn(Carbon $to) => $to->format('H:i'))
                ->sortable(),
            Column::make(__('Status'), "status")
                ->format(fn(int $status) => view('components.appointment.status-badge', ['status' => $status]))
                ->sortable(),
            Column::make(__('Price'), "price")
                ->sortable(),
            Column::make(__('Currency'), "currency")
                ->sortable(),
            //Column::make(__('Created at'), "created_at")
            //    ->sortable(),
            //Column::make(__('Updated at'), "updated_at")
            //    ->sortable(),
        ];
    }
}
