<?php

namespace App\Http\Livewire;

use App\Models\Aim;
use App\Models\Objective;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentAim extends Component
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
    public $aim_id;

    public $objectives;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'code' => 'required|max:200',
        'description' => 'required',
        'objective_id' => 'required'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->objectives = Objective::all();
    }
    
    public function render()
    {
        $Query = Aim::query()
        ->when($this->search, function($query){
            $query->where('code', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'DESC')->paginate(7);
        
        $aims = $Query;
        return view('livewire.component-aim', compact('aims'));
    }

    public function store()
    {
        $this->validate();

        $aim = new Aim();
        $aim->code = $this->code;
        $aim->description = $this->description;        
        $aim->objective_id = $this->objective_id;
        $aim->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->aim_id = $id;
        
        $aim = Aim::find($id);
        
        $this->code = $aim->code;
        $this->description = $aim->description;
        $this->objective_id = $aim->objective_id;

        $this->activity = "edit";
    }

    public function update()
    {
        $aim = Aim::find($this->aim_id);

        $this->validate();

        $aim->code = $this->code;
        $aim->description = $this->description;
        $aim->objective_id = $this->objective_id;
        $aim->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->aim_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $aim = Aim::find($this->aim_id);
        $aim->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['code', 'description', 'objective_id', 'aim_id']);
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
