<?php

namespace App\Http\Livewire;

use App\Models\Observation;
use App\Models\Planning;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentObservation extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $user;
    public $planning;
    public $observation_id;

    public $description;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'description' => 'required',
    ];

    public function mount(Planning $planning)
    {
        $this->user = auth()->user();
        $this->planning = $planning;

        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }

    public function render()
    {
        $Query = Observation::query()
            ->when($this->search, function ($query) {
                $query->where('description', 'like', '%' . $this->search . '%');
            });

        $observations = $Query->where('planning_id', $this->planning->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-observation', compact('observations'));
    }

    public function store()
    {
        $this->validate();

        $observation = new Observation();
        $observation->planning_id = $this->planning->id;
        $observation->description = $this->description;
        $observation->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->observation_id = $id;

        $observation = Observation::find($id);

        $this->description = $observation->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $observation = Observation::find($this->observation_id);

        $this->validate();

        $observation->description = $this->description;
        $observation->save();

        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->observation_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $observation = Observation::find($this->observation_id);
        $observation->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['description', 'observation_id']);
        $this->iteration++;
        $this->activity = "create";
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
