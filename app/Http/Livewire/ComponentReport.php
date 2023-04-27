<?php

namespace App\Http\Livewire;

use App\Models\Planning;
use App\Models\Sector;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class ComponentReport extends Component
{
    use WithPagination;

    public $search;

    public $sector_id;
    public $type_id;

    public $sectors;

    public $types;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->search = null;
        $this->sector_id = null;
        $this->sectors = Sector::all();
        $this->types = Type::all();
    }

    public function render()
    {
        $QueryReport = Planning::query()
        ->when($this->search, function($query){
            $query->where('code', 'like', '%' . $this->search . '%')->orWhere('result_description', 'like', '%' . $this->search . '%')->orWhere('action_description', 'like', '%' . $this->search . '%');
        })
        ->when($this->sector_id, function($query){
            $query->where('sector_id', $this->sector_id);
        })
        ->when($this->type_id, function($query){
            $query->whereHas('types', function($query) {
                $query->where('types.id', $this->type_id);
            });
        })
        ->paginate(7);

        $plannings = $QueryReport;
        return view('livewire.component-report', compact('plannings'));
    }

    public function clear()
    {
        $this->reset(['sector_id']);
    }

    public function resetSearch()
    {
        $this->reset(['search']);
        $this->updatingSearch();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSectorId()
    {
        $this->resetPage();
    }

    public function updatingTypeId()
    {
        $this->resetPage();
    }
}
