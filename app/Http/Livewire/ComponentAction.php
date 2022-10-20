<?php

namespace App\Http\Livewire;

use App\Models\Action;
use App\Models\Goal;
use App\Models\Hub;
use App\Models\Result;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentAction extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $name;
    public $description;
    public $goal_id;
    public $result_id;
    public $hub_id;
    public $action_id;

    public $goals;
    public $results;
    public $hubs;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200',
        'description' => 'required|max:200',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;

        $this->goals = Goal::all();
        $this->results = Result::all();
        $this->hubs = Hub::all();
    }

    public function render()
    {
        $Query = Action::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $actions = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-action', compact('actions'));
    }

    public function store()
    {
        $this->validate();

        if ($this->hub_id != null || $this->goal_id != null || $this->result_id != null) {
            if ($this->goal_id == null) {
                $this->goal_id = null;
            }

            if ($this->hub_id == null) {
                $this->hub_id = null;
            }

            if ($this->result_id == null) {
                $this->result_id = null;
            }

            $action = new Action();
            $action->goal_id = $this->goal_id;
            $action->hub_id = $this->hub_id;
            $action->result_id = $this->result_id;
            $action->name = $this->name;
            $action->description = $this->description;
            $action->save();

            $this->clear();
            toast()
                ->success('Se guardo correctamente')
                ->push();
        } else {
            toast()
                ->warning('Debe Selecionar una Meta o Eje y/o Resultado')
                ->push();
        }
    }

    public function edit($id)
    {
        $this->action_id = $id;

        $action = Action::find($id);

        $this->goal_id = $action->goal_id;
        $this->hub_id = $action->hub_id;
        $this->result_id = $action->result_id;
        $this->name = $action->name;
        $this->description = $action->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $action = Action::find($this->action_id);

        $this->validate();

        if ($this->hub_id != null || $this->goal_id != null || $this->result_id != null) {
            if ($this->goal_id == null) {
                $this->goal_id = null;
            }

            if ($this->hub_id == null) {
                $this->hub_id = null;
            }

            if ($this->result_id == null) {
                $this->result_id = null;
            }

            $action->goal_id = $this->goal_id;
            $action->hub_id = $this->hub_id;
            $action->result_id = $this->result_id;
            $action->name = $this->name;
            $action->description = $this->description;
            $action->save();

            $this->activity = "create";
            $this->clear();
            toast()
                ->success('Se actualizo correctamente')
                ->push();
        } else {
            toast()
                ->warning('Debe Selecionar una Meta o Eje y/o Resultado')
                ->push();
        }
    }

    public function modalDelete($id)
    {
        $this->action_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $action = Action::find($this->action_id);
        $action->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['goal_id', 'hub_id', 'result_id', 'name', 'description', 'action_id']);
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
