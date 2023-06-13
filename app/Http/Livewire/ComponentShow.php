<?php

namespace App\Http\Livewire;

use App\Models\Planning;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentShow extends Component
{
    use WithPagination;
    use WireToast;
    
    public $IdPlanning;

    public $planning_id;
    public $type_id;
    public $is_approved;

    public $types;

    public $addModalType;
    public $deleteTypeModal;
    public $validateModal; 

    public function mount(Planning $planning)
    {
        $this->IdPlanning = $planning->id;
        $this->types = Type::all();
    }

    public function render()
    {
        $planning = Planning::find($this->IdPlanning);
        return view('livewire.component-show', compact('planning'));
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

    public function modalValidate($id)
    {
        $this->planning_id = $id;

        $this->validateModal = true;
    }

    public function validatePlanning()
    {
        $this->validate([
            'is_approved' => 'required'
        ]);

        $planning = Planning::find($this->planning_id);
        $planning->is_approved = $this->is_approved;
        $planning->save();

        $this->validateModal = false;
        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['planning_id', 'type_id', 'is_approved']);
    }
}
