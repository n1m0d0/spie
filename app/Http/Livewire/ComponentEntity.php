<?php

namespace App\Http\Livewire;

use App\Models\Entity;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentEntity extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $parent_id;
    public $name;
    public $acronym;

    public $entity_id;

    public $parents;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'parent_id' => 'nullable',
        'name' => 'required|max:200',
        'acronym' => 'required|max:200',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->parents = Entity::all();
    }
    
    public function render()
    {
        $Query = Entity::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $entities = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-entity', compact('entities'));
    }

    public function store()
    {
        $this->validate();

        $entity = new Entity();
        $entity->entity_id = $this->parent_id;
        $entity->name = $this->name;
        $entity->acronym = $this->acronym;
        $entity->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->entity_id = $id;
        
        $entity = Entity::find($id);
        
        $this->parent_id = $entity->entity_id;
        $this->name = $entity->name;
        $this->acronym = $entity->acronym;

        $this->activity = "edit";
    }

    public function update()
    {
        $entity = Entity::find($this->entity_id);

        $this->validate();

        if($this->parent_id == "null")
        {
            $this->parent_id = null;
        }

        $entity->entity_id = $this->parent_id;
        $entity->name = $this->name;
        $entity->acronym = $this->acronym;
        $entity->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->entity_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $entity = Entity::find($this->entity_id);
        $entity->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'acronym', 'entity_id', 'parent_id']);
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
