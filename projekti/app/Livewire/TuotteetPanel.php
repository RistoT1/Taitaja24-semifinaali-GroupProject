<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use App\Models\Tuote;

class TuotteetPanel extends Component
{
    use WithPagination;

    // Search filters
    public $searchTerm = '';
    public $searchCategory = '';
    public $searchOrder = '';

    // Keep filters in URL for bookmarking
    protected $queryString = ['searchTerm', 'searchCategory', 'searchOrder'];

    // Reset pagination when filters change
    public function updatedSearchTerm()
    {
        $this->resetPage();
    }


    public function updatedSearchCategory()
    {
        $this->resetPage();
    }

    public function updatedSearchOrder()
    {
        $this->resetPage();
    }

    public function productView($id)
    {
        $this->dispatch('productView', id: $id);
    }

    // Cached: Only recalculates when searchTerm, searchCategory, or searchOrder changes
    #[Computed]
    public function tuotteet()
    {
        $query = Tuote::query();

        if ($this->searchTerm) {
            $query->where('Nimi', 'like', '%' . $this->searchTerm . '%');
        }

        if ($this->searchCategory) {
            $query->where('Kategoria', $this->searchCategory);
        }

        // Apply sorting
        match ($this->searchOrder) {
            'created_at_asc' => $query->orderBy('Lisätty', 'asc'),
            'created_at_desc' => $query->orderBy('Lisätty', 'desc'),
            'price_asc' => $query->orderBy('Hinta', 'asc'),
            'price_desc' => $query->orderBy('Hinta', 'desc'),
            default => $query->orderBy('Lisätty', 'desc'),
        };

        // Paginate to reduce DOM bloat
        return $query->paginate(20);
    }

    // Cached: Counts active vs total products based on current filters
    #[Computed]
    public function panelData()
    {
        $query = Tuote::query();

        if ($this->searchTerm) {
            $query->where('Nimi', 'like', '%' . $this->searchTerm . '%');
        }

        if ($this->searchCategory) {
            $query->where('Kategoria', $this->searchCategory);
        }

        $filtered = $query->get();

        return [
            'ActiveCount' => $filtered->where('Tila', 1)->count(),
            'TotalCount' => $filtered->count(),
        ];
    }

    // Cached: Categories list (rarely changes, cached until component refreshes)
    #[Computed]
    public function categories()
    {
        return Tuote::distinct()
            ->whereNotNull('Kategoria')
            ->pluck('Kategoria')
            ->sort();
    }

    public function render()
    {
        return view('livewire.tuotteet-panel');
    }
}