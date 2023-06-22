<?php

namespace App\Http\Livewire;

use App\Models\Planning;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentPmdi extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $action_id;
    public $sector_id;
    public $entity_id;
    public $code;
    public $result_description;
    public $action_description;
    public $action_code;
    public $planning_id;

    public $activity;
    public $iteration;
    public $search;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'planning_id' => 'required',
        'action_id' => 'required',
        'sector_id' => 'required',
        'entity_id' => 'nullable',
        'code' => 'required',
        'result_description' => 'required',
        'action_description' => 'required',
        'action_code' => 'nullable'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->entity_id = auth()->user()->entity_id;
        $this->deleteModal = false;
    }
    
    public function render()
    {
        $Query = Planning::query()
        ->when($this->search, function ($query) {
            $query->where('code', 'like', '%' . $this->search . '%')->orWhere('result_description', 'like', '%' . $this->search . '%')->orWhere('action_description', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'DESC')->paginate(7);
        
        $plannings = $Query;
        return view('livewire.component-pmdi', compact('plannings'));
    }

    public function select($id)
    {
        $this->planning_id = $id;

        $planning = Planning::find($id);

        $this->action_id = $planning->action_id;
        $this->sector_id = $planning->sector_id;
        $this->code = $planning->code;
        $this->result_description = $planning->result_description;
        $this->action_description = $planning->action_description;
        $this->action_code = $planning->action_code;
    }

    public function store()
    {
        $this->validate();

        $planning = new Planning();

        $planning->planning_id = $this->planning_id;
        $planning->action_id = $this->action_id;
        $planning->sector_id = $this->sector_id;
        $planning->entity_id = $this->entity_id;
        $planning->code = $this->code;
        $planning->result_description = $this->result_description;
        $planning->action_description = $this->action_description;
        $planning->action_code = $this->action_code;
        $planning->save();

        $planning->types()->attach(8);

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['planning_id', 'action_id', 'sector_id', 'entity_id', 'code', 'result_description', 'action_description', 'action_code']);
        $this->iteration++;
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
