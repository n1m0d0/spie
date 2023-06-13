<?php

namespace App\Http\Livewire;

use App\Models\Entity;
use App\Models\Planning;
use App\Models\Sector;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentVerify extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $user;
    public $entity;
    public $entity_id;
    public $sector_id;
    public $planning_id;

    public $type_id;
    public $is_approved;

    public $types;
    public $entities;
    public $sectors;

    public $description;

    public $addModalType;
    public $deleteTypeModal;
    public $validateModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->user = auth()->user();
        $this->entity = auth()->user()->entity_id;

        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->addModalType = false;
        $this->deleteTypeModal = false;
        $this->validateModal = false;

        $this->types = Type::all();
        $this->entities = Entity::where('entity_id', $this->entity)->get();
        $this->sectors = Sector::all();
    }

    public function render()
    {
        $Query = Planning::query()
            ->when($this->entity_id, function ($query) {
                $query->where('entity_id', $this->entity_id);
            })
            ->when($this->sector_id, function ($query) {
                $query->where('sector_id', $this->sector_id);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('code', 'like', '%' . $this->search . '%')->orWhere('result_description', 'like', '%' . $this->search . '%')->orWhere('action_description', 'like', '%' . $this->search . '%');
                });
            });
        if ($this->entity_id == null) {
            $Query->where('entity_id', $this->entity);
        }
        $plannings = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-verify', compact('plannings'));
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
        $this->iteration++;
        $this->activity = "create";
    }

    public function resetSearch()
    {
        $this->reset(['search']);
        $this->updatingSearch();
    }

    public function updatingEntityId()
    {
        $this->resetPage();
    }

    public function updatingSectorId()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
