<?php

namespace App\Http\Livewire;

use App\Models\Goal;
use App\Models\Hub;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentGoal extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $name;
    public $description;
    public $hub_id;
    public $goal_id;

    public $hubs;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200',
        'description' => 'required|max:200',
        'hub_id' => 'required'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->hubs = Hub::all();
    }
    
    public function render()
    {
        $Query = Goal::query()
        ->when($this->search, function($query){
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'DESC')->paginate(7);
        
        $goals = $Query;
        return view('livewire.component-goal', compact('goals'));
    }

    public function store()
    {
        $this->validate();

        $goal = new Goal();
        $goal->name = $this->name;
        $goal->description = $this->description;
        $goal->hub_id = $this->hub_id;
        $goal->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->goal_id = $id;
        
        $goal = Goal::find($id);
        
        $this->name = $goal->name;
        $this->description = $goal->description;
        $this->hub_id = $goal->hub_id;

        $this->activity = "edit";
    }

    public function update()
    {
        $goal = Goal::find($this->goal_id);

        $this->validate();

        $goal->name = $this->name;
        $goal->description = $this->description;
        $goal->hub_id = $this->hub_id;
        $goal->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->goal_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $goal = Goal::find($this->goal_id);
        $goal->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'description', 'hub_id', 'goal_id']);
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
