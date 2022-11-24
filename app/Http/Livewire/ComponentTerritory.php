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
    public $district_id;
    public $community;
    public $territory_id;

    public $departments;
    public $municipalities;
    public $districts;

    public $actions;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'district_id' => 'required',
        'community' => 'required',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        
        $this->departments = Department::all();
        $this->municipalities = collect();
        $this->districts = collect();
    }
    
    public function render()
    {
        $Query = Territory::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('description', 'like', '%' . $this->search . '%');
        }
        $territories = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-territory', compact('territories'));
    }

    public function updatedDepartmentId()
    {
        $this->municipalities = Municipality::where('department_id', $this->department_id)->get();
        $this->municipality_id = null;
    }

    public function updatedMunicipalityId()
    {
        $this->districts = District::where('municipality_id', $this->municipality_id)->get();
        $this->district_id = null;
    }

    public function store()
    {
        $this->validate();

        $territory = new Territory();
        $territory->planning_id = $this->planning->id;
        $territory->district_id = $this->district_id;
        $territory->community = $this->community;
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
        
        $this->department_id = $territory->district->municipality->department->id;
        $this->municipality_id = $territory->district->municipality->id;
        $this->district_id = $territory->district_id;
        $this->community = $territory->community;

        $this->activity = "edit";
    }

    public function update()
    {
        $territory = Territory::find($this->territory_id);

        $this->validate();

        $territory->district_id = $this->district_id;
        $territory->community = $this->community;
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
        $this->reset(['department_id', 'municipality_id', 'district_id', 'community', 'territory_id']);
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
