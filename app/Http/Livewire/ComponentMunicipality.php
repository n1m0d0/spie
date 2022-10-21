<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Municipality;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentMunicipality extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $name;
    public $department_id;
    public $municipality_id;

    public $departments;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200',
        'department_id' => 'required',
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
        $Query = Municipality::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $municipalities = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-municipality', compact('municipalities'));
    }

    public function store()
    {
        $this->validate();

        $municipality = new Municipality();
        $municipality->name = $this->name;
        $municipality->department_id = $this->department_id;
        $municipality->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->municipality_id = $id;
        
        $municipality = Municipality::find($id);
        
        $this->name = $municipality->name;
        $this->department_id = $municipality->department_id;

        $this->activity = "edit";
    }

    public function update()
    {
        $municipality = Municipality::find($this->municipality_id);

        $this->validate();

        $municipality->name = $this->name;
        $municipality->department_id = $this->department_id;
        $municipality->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->municipality_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $municipality = Municipality::find($this->municipality_id);
        $municipality->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'department_id', 'municipality_id']);
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
