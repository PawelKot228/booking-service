<?php

namespace App\Http\Livewire\DataTable;

trait HasTooltips
{
    public function customView(): string
    {
        return 'components.datatable.tooltips';
    }
}
