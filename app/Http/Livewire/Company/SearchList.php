<?php

namespace App\Http\Livewire\Company;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class SearchList extends Component
{
    use WithPagination;

    public int|string $companyId;
    public bool $isLoading = true;

    public string $sortBy = 'best';

    public ?array $categories = null;
    public ?array $subcategories = null;
    public ?float $lat = null;
    public ?float $lng = null;

    protected $listeners = [
        'companyListRefresh' => 'refreshTable',
    ];

    public function render(CompanyService $companyService)
    {
        $request = new Request([
            'categories' => $this->categories,
            'subcategories' => $this->subcategories,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'orderBy' => $this->sortBy,
        ]);

        $companies = $companyService->listQuery(Company::with(['categories']), $request);

        $companies = $companies->paginate(5);

        $this->resetPage();
        $this->isLoading = false;

        return view('livewire.company.search-list', compact('companies'));
    }

    public function refreshTable(?array $parameters): void
    {
        $this->categories = !empty($parameters['categories'] ?? null) ? $parameters['categories'] : null;
        $this->subcategories = !empty($parameters['subcategories'] ?? null) ? $parameters['subcategories'] : null;
        $this->lat = $parameters['lat'] ?? null;
        $this->lng = $parameters['lng'] ?? null;

        if (!empty($parameters['orderBy'] ?? null)) {
            $this->sortBy = $parameters['orderBy'] ?? null;
        }

        $this->isLoading = true;

        $this->emit('refreshComponent');
    }
}
