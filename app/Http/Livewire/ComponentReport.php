<?php

namespace App\Http\Livewire;

use App\Models\Planning;
use Livewire\Component;
use Livewire\WithPagination;

class ComponentReport extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $Query = Planning::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $plannings = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-report', compact('plannings'));
    }
}
