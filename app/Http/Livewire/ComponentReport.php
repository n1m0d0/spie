<?php

namespace App\Http\Livewire;

use App\Exports\PlanningExport;
use App\Models\Entity;
use App\Models\Planning;
use App\Models\Sector;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class ComponentReport extends Component
{
    use WithPagination;

    public $search;

    public $entityFather;

    public $sector_id;
    public $type_id;
    public $entity_id;
    public $indicator_type_id;

    public $sectors;
    public $entities;
    public $types;
    public $indicator_types;

    public $resultQuery;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->search = null;
        $this->entityFather = auth()->user()->entity;
        $this->sector_id = null;
        $this->sectors = Sector::all();
        $this->entities = Entity::where('entity_id', $this->entityFather->id)->get();
        $this->types = Type::all();
        $this->indicator_types = Type::all();
    }

    public function render()
    {
        $QueryReport = Planning::query()
            ->when($this->search, function ($query) {
                $query->where('code', 'like', '%' . $this->search . '%')->orWhere('result_description', 'like', '%' . $this->search . '%')->orWhere('action_description', 'like', '%' . $this->search . '%');
            })
            ->when($this->sector_id, function ($query) {
                $query->where('sector_id', $this->sector_id);
            })
            ->when($this->entity_id, function ($query) {
                $query->where('entity_id', $this->entity_id);
            })
            ->when($this->type_id, function ($query) {
                $query->whereHas('types', function ($query) {
                    $query->where('types.id', $this->type_id);
                });
            });

        if ($this->entity_id == null) {
            //$QueryReport = $QueryReport->where('entity_id', $this->entityFather->id);
            /*$QueryReport = $QueryReport->whereHas('entity', function ($query) {
                $query->where('entity_id', $this->entityFather->id);
            });*/
            $QueryReport = $QueryReport->whereIn('entity_id', function ($query) {
                $query->select('id')
                    ->from('entities')
                    ->where('id', $this->entityFather->id)
                    ->orWhere('entity_id', $this->entityFather->id)
                    ->orWhereIn('entity_id', function ($query) {
                        $query->select('id')
                            ->from('entities')
                            ->where('entity_id', $this->entityFather->id);
                    });
            });
        }

        $this->resultQuery = $QueryReport->get();
        $plannings = $QueryReport->paginate(7);
        return view('livewire.component-report', compact('plannings'));
    }

    public function exportExcel()
    {
        //return new PlanningExport($this->search, $this->sector_id, $this->entity_id, $this->type_id);
        return new PlanningExport($this->resultQuery, $this->indicator_type_id);
    }

    public function clear()
    {
        $this->reset(['sector_id']);
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

    public function updatingSectorId()
    {
        $this->resetPage();
    }

    public function updatingEntityId()
    {
        $this->resetPage();
    }

    public function updatingTypeId()
    {
        $this->resetPage();
    }
}
