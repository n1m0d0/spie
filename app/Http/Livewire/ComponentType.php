<?php

namespace App\Http\Livewire;

use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentType extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $name;
    public $description;
    public $type_id;

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
        $Query = Type::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $types = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-type', compact('types'));
    }

    public function store()
    {
        $this->validate();

        $type = new Type();
        $type->name = $this->name;
        $type->description = $this->description;
        $type->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->type_id = $id;
        
        $type = Type::find($id);
        
        $this->name = $type->name;
        $this->description = $type->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $type = Type::find($this->type_id);

        $this->validate();

        $type->name = $this->name;
        $type->description = $this->description;
        $type->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->type_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $type = Type::find($this->type_id);
        $type->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'description', 'type_id']);
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
