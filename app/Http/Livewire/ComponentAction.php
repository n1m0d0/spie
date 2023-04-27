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
    public $result_id;
    public $action_id;

    public $results;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200',
        'description' => 'required|max:200',
        'result_id' => 'required'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;

        $this->results = Result::all();
    }

    public function render()
    {
        $Query = Action::query()
        ->when($this->search, function($query){
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'DESC')->paginate(7);
        
        $actions = $Query;
        return view('livewire.component-action', compact('actions'));
    }

    public function store()
    {
        $this->validate();

        $action = new Action();
        $action->name = $this->name;
        $action->description = $this->description;
        $action->result_id = $this->result_id;
        $action->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->action_id = $id;

        $action = Action::find($id);

        $this->name = $action->name;
        $this->description = $action->description;
        $this->result_id = $action->result_id;

        $this->activity = "edit";
    }

    public function update()
    {
        $action = Action::find($this->action_id);

        $this->validate();

        $action->name = $this->name;
        $action->description = $this->description;
        $action->result_id = $this->result_id;
        $action->save();

        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
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
        $this->reset(['name', 'description', 'result_id', 'action_id']);
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
