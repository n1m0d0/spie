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
use App\Models\Type;
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

    public $user_id;
    public $entity;

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

    public $parent_id;
    public $type_id;

    public $pillars;
    public $hubs;
    public $goals;
    public $results;
    public $actions;
    public $sectors;
    public $entities;

    public $types;
    public $parents;

    public $deleteModal;
    public $addModalType;
    public $deleteTypeModal;

    //input select
    public $inputSearchPillar;
    public $inputSearchHub;
    public $inputSearchGoal;
    public $inputSearchResult;
    public $inputSearchAction;
    public $inputSearchEntity;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'parent_id' => 'nullable',
        'action_id' => 'required',
        'sector_id' => 'required',
        'entity_id' => 'required',
        'code' => 'required',
        'result_description' => 'required',
        'action_description' => 'required'
    ];

    public function mount()
    {
        $this->user_id = auth()->user()->id;
        $this->entity = auth()->user()->entity_id;

        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->addModalType = false;
        $this->pillars = Pillar::all();
        $this->hubs = collect();
        $this->goals = collect();
        $this->results = collect();
        $this->actions = collect();
        $this->sectors = Sector::all();
        $this->entities = Entity::all();

        $this->types = Type::all();
        $this->parents = Planning::where('entity_id', $this->entity)->orderBy('id', 'DESC')->get();
    }

    public function render()
    {
        $Query = Planning::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('code', 'like', '%' . $this->search . '%')->orWhere('result_description', 'like', '%' . $this->search . '%')->orWhere('action_description', 'like', '%' . $this->search . '%');
        }

        $searchPillars = Pillar::query();
        if ($this->inputSearchPillar != null) {
            $searchPillars = $searchPillars->where('name', 'like', '%' . $this->inputSearchPillar . '%')->get();
        }

        $searchHubs = collect();
        if ($this->inputSearchHub != null) {
            $searchHubs = Pillar::find($this->pillar_id)->hubs()->where('name', 'like', '%' . $this->inputSearchHub . '%')->get();
        }

        $searchGoals = Goal::query();
        if ($this->inputSearchGoal != null) {
            $searchGoals = $searchGoals->where('hub_id', $this->hub_id)->where('name', 'like', '%' . $this->inputSearchGoal . '%')->get();
        }

        $searchResults = Result::query();
        if ($this->inputSearchResult != null) {
            $searchResults = $searchResults->where('goal_id', $this->goal_id)->where('name', 'like', '%' . $this->inputSearchResult . '%')->get();
        }

        $searchActions = Action::query();
        if ($this->inputSearchAction != null) {
            $searchActions = $searchActions->where('result_id', $this->result_id)->where('name', 'like', '%' . $this->inputSearchAction . '%')->get();
        }

        $searchEntities = Entity::query();
        if ($this->inputSearchEntity != null) {
            $searchEntities = $searchEntities->where('name', 'like', '%' . $this->inputSearchEntity . '%')->get();
        }

        $plannings = $Query->where('entity_id', $this->entity)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-planning', compact('plannings', 'searchPillars', 'searchHubs', 'searchGoals', 'searchResults', 'searchActions', 'searchEntities'));
    }

    public function selectPillar($id)
    {
        $this->pillar_id = $id;
        $this->inputSearchPillar = null;

        $this->updatedPillarId();
    }

    public function selectHub($id)
    {
        $this->hub_id = $id;
        $this->inputSearchHub = null;

        $this->updatedHubId();
    }

    public function selectGoal($id)
    {
        $this->goal_id = $id;
        $this->inputSearchGoal = null;

        $this->updatedGoalId();
    }

    public function selectResult($id)
    {
        $this->result_id = $id;
        $this->inputSearchResult = null;

        $this->updatedResultId();
    }

    public function selectAction($id)
    {
        $this->action_id = $id;
        $this->inputSearchAction = null;

        $this->updatedActionId();
    }

    public function selectEntity($id)
    {
        $this->entity_id = $id;
        $this->inputSearchEntity = null;
    }

    public function updatedPillarId()
    {
        if ($this->pillar_id != null) {
            $this->hubs = collect();
            $this->goals = collect();
            $this->results = collect();
            $this->actions = collect();
            $this->result_description = null;
            $this->action_description = null;

            $pillar = Pillar::find($this->pillar_id);
            $this->hubs = $pillar->hubs;
            $this->hub_id = null;
        } else {
            $this->hub_id = null;
            $this->hubs = collect();
            $this->goals = collect();
            $this->results = collect();
            $this->actions = collect();
            $this->result_description = null;
            $this->action_description = null;
        }
    }

    public function updatedHubId()
    {
        if ($this->hub_id != null) {
            $this->goals = collect();
            $this->results = collect();
            $this->actions = collect();
            $this->result_description = null;
            $this->action_description = null;

            $this->goals = Goal::where('hub_id', $this->hub_id)->get();
            $this->goal_id = null;
        } else {
            $this->goal_id = null;
            $this->goals = collect();
            $this->results = collect();
            $this->actions = collect();
            $this->result_description = null;
            $this->action_description = null;
        }
    }

    public function updatedGoalId()
    {
        if ($this->goal_id != null) {
            $this->results = collect();
            $this->actions = collect();
            $this->result_description = null;
            $this->action_description = null;

            $this->results = Result::where('goal_id', $this->goal_id)->get();
            $this->result_id = null;
        } else {
            $this->result_id = null;
            $this->results = collect();
            $this->actions = collect();
            $this->result_description = null;
            $this->action_description = null;
        }
    }

    public function updatedResultId()
    {
        if ($this->goal_id != null && $this->result_id != null) {
            $this->actions = collect();
            $this->result_description = null;
            $this->action_description = null;

            $this->actions = Action::where('result_id', $this->result_id)->get();
            $this->action_id = null;
            $this->result_description = Result::find($this->result_id)->description;
        } else {
            $this->action_id = null;
            $this->actions = collect();
            $this->result_description = null;
            $this->action_description = null;
        }
    }

    public function updatedActionId()
    {
        if ($this->action_id != null) {
            $this->action_description = Action::find($this->action_id)->description;
        } else {
            $this->action_description = null;
        }
    }

    public function store()
    {
        $this->validate();

        $planning = new Planning();
        
        $planning->planning_id = $this->parent_id;
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

        $this->parent_id = $planning->planning_id;
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

        if ($this->action_id != null) {
            $this->validate();

            $planning->planning_id = $this->parent_id;
            $planning->action_id = $this->action_id;
            $planning->sector_id = $this->sector_id;
            $planning->entity_id = $this->entity_id;
            $planning->code = $this->code;
            $planning->result_description = $this->result_description;
            $planning->action_description = $this->action_description;
            $planning->save();
        } else {
            $this->validate([
                'parent_id' => 'nullable',
                'sector_id' => 'required',
                'entity_id' => 'required',
                'code' => 'required',
                'result_description' => 'required',
                'action_description' => 'required'
            ]);

            $planning->planning_id = $this->parent_id;
            $planning->sector_id = $this->sector_id;
            $planning->entity_id = $this->entity_id;
            $planning->code = $this->code;
            $planning->result_description = $this->result_description;
            $planning->action_description = $this->action_description;
            $planning->save();
        }


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

    public function modalAddType($id)
    {
        $this->planning_id = $id;

        $this->addModalType = true;
    }

    public function addType()
    {
        $this->validate([
            'type_id' => 'required'
        ]);

        $planning = Planning::find($this->planning_id);
        $planning->types()->attach($this->type_id);

        $this->addModalType = false;
        $this->clear();
        toast()
            ->success('Se añadido correctamente')
            ->push();
    }

    public function modalDeleteType($id, $idType)
    {
        $this->planning_id = $id;
        $this->type_id = $idType;

        $this->deleteTypeModal = true;
    }

    public function deleteType()
    {
        $planning = Planning::find($this->planning_id);
        $planning->types()->detach($this->type_id);

        $this->deleteTypeModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['pillar_id', 'hub_id', 'goal_id', 'result_id', 'action_id', 'sector_id', 'entity_id', 'code', 'result_description', 'action_description', 'planning_id', 'parent_id', 'type_id']);
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
