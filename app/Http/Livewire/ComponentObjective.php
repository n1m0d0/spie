<?php

namespace App\Http\Livewire;

use App\Models\Objective;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentObjective extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $code;
    public $description;
    public $objective_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'code' => 'required|max:200',
        'description' => 'required',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }
    
    public function render()
    {
        $Query = Objective::query()
        ->when($this->search, function($query){
            $query->where('code', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'DESC')->paginate(7);

        $objectives = $Query;
        return view('livewire.component-objective', compact('objectives'));
    }

    public function store()
    {
        $this->validate();

        $objective = new Objective();
        $objective->code = $this->code;
        $objective->description = $this->description;
        $objective->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->objective_id = $id;
        
        $objective = Objective::find($id);
        
        $this->code = $objective->code;
        $this->description = $objective->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $objective = Objective::find($this->objective_id);

        $this->validate();

        $objective->code = $this->code;
        $objective->description = $this->description;
        $objective->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->objective_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $objective = Objective::find($this->objective_id);
        $objective->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['code', 'description', 'objective_id']);
        $this->iteration++;
        $this->activity = "create";
    }

    public function resetSearch()
    {
        $this->reset(['search']);
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
