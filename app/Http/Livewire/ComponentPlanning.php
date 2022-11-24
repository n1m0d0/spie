<?php

namespace App\Http\Livewire;

use App\Models\Action;
use App\Models\Entity;
use App\Models\Goal;
use App\Models\Hub;
use App\Models\Pillar;
use Livewire\Component;
use App\Models\Planning;
use App\Models\Result;
use App\Models\Sector;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentPlanning extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $pillar_id;
    public $hub_id;
    public $goal_id;
    public $result_id;
    public $action_id;
    public $sector_id;
    public $entity_id;
    public $code;
    public $result_description;
    public $action_description;
    public $planning_id;

    public $pillars;
    public $hubs;
    public $goals;
    public $results;
    public $actions;
    public $sectors;
    public $entities;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'action_id' => 'required',
        'sector_id' => 'required',        
        'entity_id' => 'required',
        'code' => 'required',
        'result_description' => 'required',
        'action_description' => 'required'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->pillars = Pillar::all();
        $this->hubs = collect();
        $this->goals = collect();
        $this->results = collect();
        $this->actions = collect();
        $this->sectors = Sector::all();
        $this->entities = Entity::all();
    }

    public function render()
    {
        $Query = Planning::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('code', 'like', '%' . $this->search . '%');
        }
        $plannings = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-planning', compact('plannings'));
    }
    
    public function updatedPillarId()
    {
        $this->hubs = Hub::where('pillar_id', $this->pillar_id)->get();
        $this->hub_id = null;
    }

    public function updatedHubId()
    {
        $this->goals = Goal::where('hub_id', $this->hub_id)->get();
        $this->goal_id = null;
    }

    public function updatedGoalId()
    {
        $this->results = Result::where('goal_id', $this->goal_id)->get();
        $this->result_id = null;
    }

    public function updatedResultId()
    {
        $this->actions = Action::where('result_id', $this->result_id)->get();
        $this->action_id = null;
    }

    public function store()
    {
        $this->validate();

        $planning = new Planning();
        $planning->action_id = $this->action_id;
        $planning->sector_id = $this->sector_id;
        $planning->entity_id = $this->entity_id;
        $planning->code = $this->code;
        $planning->result_description = $this->result_description;
        $planning->action_description = $this->action_description;
        $planning->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->planning_id = $id;
        
        $planning = Planning::find($id);

        $this->pillar_id = $planning->action->result->goal->hub->pillar->id;        
        $this->hub_id = $planning->action->result->goal->hub->id;
        $this->goal_id = $planning->action->result->goal->id;
        $this->result_id = $planning->action->result->id;
        $this->action_id = $planning->action_id;
        $this->sector_id = $planning->sector_id;
        $this->entity_id = $planning->entity_id;
        $this->code = $planning->code;
        $this->result_description = $planning->result_description;
        $this->action_description = $planning->action_description;

        $this->activity = "edit";
    }

    public function update()
    {
        $planning = Planning::find($this->planning_id);

        $this->validate();

        $planning->action_id = $this->action_id;
        $planning->sector_id = $this->sector_id;
        $planning->entity_id = $this->entity_id;
        $planning->code = $this->code;
        $planning->result_description = $this->result_description;
        $planning->action_description = $this->action_description;
        $planning->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->planning_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $planning = Planning::find($this->planning_id);
        $planning->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['pillar_id', 'hub_id', 'goal_id', 'result_id', 'action_id', 'sector_id', 'entity_id', 'code', 'result_description', 'action_description', 'planning_id']);
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
