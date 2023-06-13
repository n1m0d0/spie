<?php

namespace App\Http\Livewire;

use App\Models\Observation;
use App\Models\Planning;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentShowObservation extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $planning;
    public $observation_id;

    public $is_complete;

    public $completeModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount(Planning $planning)
    {
        $this->planning = $planning;

        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->completeModal = false;
    }

    public function render()
    {
        $Query = Observation::query()
            ->when($this->search, function ($query) {
                $query->where('description', 'like', '%' . $this->search . '%');
            });

        $observations = $Query->where('planning_id', $this->planning->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-show-observation', compact('observations'));
    }

    public function modalComplete($id)
    {
        $this->observation_id = $id;

        $this->completeModal = true;
    }

    public function complete()
    {
        $this->validate([
            'is_complete' => 'required'
        ]);

        $observation = observation::find($this->observation_id);
        $observation->is_complete = $this->is_complete;
        $observation->save();

        $verify = observation::where('planning_id', $this->planning->id)->where('is_complete', false)->get();

        if ($verify->count() == 0) {
            $planning = Planning::find($this->planning->id);
            $planning->is_approved = null;
            $planning->save();
        }

        $this->completeModal = false;
        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['observation_id', 'is_complete']);
        $this->iteration++;
        $this->activity = "create";
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->reset(['search']);
        $this->resetPage();
    }
}
