<?php

namespace App\Http\Livewire;

use App\Models\Planning;
use App\Models\Sector;
use Livewire\Component;
use Livewire\WithPagination;

class ComponentReport extends Component
{
    use WithPagination;

    public $search;

    public $sector_id;

    public $sectors;

    public function mount()
    {
        $this->search = null;
        $this->sector_id = null;
        $this->sectors = Sector::all();
    }

    public function render()
    {
        $Query = Planning::query();

        if ($this->sector_id != null)
        {
            $this->updatingSearch();
            $Query = $Query->where('sector_id', $this->sector_id);
        }

        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('code', 'like', '%' . $this->search . '%')->orWhere('result_description', 'like', '%' . $this->search . '%')->orWhere('action_description', 'like', '%' . $this->search . '%');
        }

        $plannings = $Query->orderBy('id', 'DESC')->paginate(7);
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
}
