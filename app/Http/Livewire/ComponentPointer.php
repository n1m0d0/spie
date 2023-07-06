<?php

namespace App\Http\Livewire;

use App\Models\Aim;
use App\Models\Pointer;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentPointer extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $code;
    public $description;
    public $aim_id;
    public $pointer_id;

    public $aims;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'code' => 'required|max:200',
        'description' => 'required',
        'aim_id' => 'required'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->aims = Aim::all();
    }
    
    public function render()
    {
        $Query = Pointer::query()
        ->when($this->search, function($query){
            $query->where('code', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'DESC')->paginate(7);
        
        $pointers = $Query;
        return view('livewire.component-pointer', compact('pointers'));
    }

    public function store()
    {
        $this->validate();

        $pointer = new Pointer();
        $pointer->code = $this->code;
        $pointer->description = $this->description;        
        $pointer->aim_id = $this->aim_id;
        $pointer->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->pointer_id = $id;
        
        $pointer = Pointer::find($id);
        
        $this->code = $pointer->code;
        $this->description = $pointer->description;
        $this->aim_id = $pointer->aim_id;

        $this->activity = "edit";
    }

    public function update()
    {
        $pointer = Pointer::find($this->pointer_id);

        $this->validate();

        $pointer->code = $this->code;
        $pointer->description = $this->description;
        $pointer->aim_id = $this->aim_id;
        $pointer->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->pointer_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $pointer = Pointer::find($this->pointer_id);
        $pointer->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['code', 'description', 'aim_id', 'pointer_id']);
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
