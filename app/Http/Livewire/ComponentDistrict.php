<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\District;
use App\Models\Municipality;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentDistrict extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $name;
    public $municipality_id;
    public $district_id;

    public $municipalities;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200',
        'municipality_id' => 'required',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->municipalities = Municipality::all();
    }
    
    public function render()
    {
        $Query = District::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $districts = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-district', compact('districts'));
    }

    public function store()
    {
        $this->validate();

        $district = new District();
        $district->name = $this->name;
        $district->municipality_id = $this->municipality_id;
        $district->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->district_id = $id;
        
        $district = District::find($id);
        
        $this->name = $district->name;
        $this->municipality_id = $district->municipality_id;

        $this->activity = "edit";
    }

    public function update()
    {
        $district = District::find($this->district_id);

        $this->validate();

        $district->name = $this->name;
        $district->municipality_id = $this->municipality_id;
        $district->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->district_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $district = District::find($this->district_id);
        $district->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'municipality_id', 'district_id']);
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
