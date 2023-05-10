<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Territory;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentTerritory extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $planning;

    public $activity;
    public $iteration;
    public $search;

    
    public $department_id;
    public $municipality_id;
    public $community;
    public $district;

    public $territory_id;

    public $departments;
    public $municipalities;

    public $actions;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'municipality_id' => 'required',
        'community' => 'required',
        'district' => 'nullable'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        
        $this->departments = Department::all();
        $this->municipalities = collect();
    }
    
    public function render()
    {
        $Query = Territory::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('description', 'like', '%' . $this->search . '%');
        }
        $territories = $Query->where('planning_id', $this->planning->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-territory', compact('territories'));
    }

    public function updatedDepartmentId()
    {
        $this->municipalities = Municipality::where('department_id', $this->department_id)->orderBy('name', 'ASC')->get();
        $this->municipality_id = null;
    }
    
    public function store()
    {
        $this->validate();

        $territory = new Territory();
        $territory->planning_id = $this->planning->id;
        $territory->municipality_id = $this->municipality_id;
        $territory->community = $this->community;
        $territory->district = $this->district;
        $territory->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->territory_id = $id;
        
        $territory = Territory::find($id);
        
        $this->department_id = $territory->municipality->department->id;
        $this->updatedDepartmentId();
        $this->municipality_id = $territory->municipality->id;
        $this->community = $territory->community;        
        $this->district = $territory->district;

        $this->activity = "edit";
    }

    public function update()
    {
        $territory = Territory::find($this->territory_id);

        $this->validate();

        $territory->municipality_id = $this->municipality_id;
        $territory->community = $this->community;
        $territory->district = $this->district;
        $territory->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->territory_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $territory = Territory::find($this->territory_id);
        $territory->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['department_id', 'municipality_id', 'community', 'district', 'territory_id']);
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
