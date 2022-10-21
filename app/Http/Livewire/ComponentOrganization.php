<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\Organization;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentOrganization extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $name;
    public $description;
    public $department_id;
    public $organization_id;

    public $departments;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200',
        'description' => 'required|max:200',
        'department_id' => 'required|max:200',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->departments = Department::all();
    }
    
    public function render()
    {
        $Query = Organization::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $organizations = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-organization', compact('organizations'));
    }

    public function store()
    {
        $this->validate();

        $organization = new Organization();
        $organization->name = $this->name;
        $organization->description = $this->description;
        $organization->department_id = $this->department_id;
        $organization->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->organization_id = $id;
        
        $organization = Organization::find($id);
        
        $this->name = $organization->name;
        $this->description = $organization->description;
        $this->department_id = $organization->department_id;

        $this->activity = "edit";
    }

    public function update()
    {
        $organization = Organization::find($this->organization_id);

        $this->validate();

        $organization->name = $this->name;
        $organization->description = $this->description;
        $organization->department_id = $this->department_id;
        $organization->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->organization_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $organization = Organization::find($this->organization_id);
        $organization->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'description', 'department_id', 'organization_id']);
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
