<?php

namespace App\Http\Livewire;

use App\Models\Dissociation;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentDissociation extends Component
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
    }
    
    public function render()
    {
        $Query = Dissociation::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $dissociations = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-dissociation', compact('dissociations'));
    }

    public function store()
    {
        $this->validate();

        $goal = new Dissociation();
        $goal->name = $this->name;
        $goal->description = $this->description;
        $goal->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->goal_id = $id;
        
        $goal = Dissociation::find($id);
        
        $this->name = $goal->name;
        $this->description = $goal->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $goal = Dissociation::find($this->goal_id);

        $this->validate();

        $goal->name = $this->name;
        $goal->description = $this->description;
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
        $goal = Dissociation::find($this->goal_id);
        $goal->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'description', 'goal_id']);
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
