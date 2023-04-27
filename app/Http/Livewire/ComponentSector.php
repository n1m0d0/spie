<?php

namespace App\Http\Livewire;

use App\Models\Sector;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentSector extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $name;
    public $description;
    public $sector_id;

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
        $Query = Sector::query()
        ->when($this->search, function($query){
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'DESC')->paginate(7);

        $sectors = $Query;
        return view('livewire.component-sector', compact('sectors'));
    }

    public function store()
    {
        $this->validate();

        $sector = new Sector();
        $sector->name = $this->name;
        $sector->description = $this->description;
        $sector->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->sector_id = $id;
        
        $sector = Sector::find($id);
        
        $this->name = $sector->name;
        $this->description = $sector->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $sector = Sector::find($this->sector_id);

        $this->validate();

        $sector->name = $this->name;
        $sector->description = $this->description;
        $sector->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->sector_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $sector = Sector::find($this->sector_id);
        $sector->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'description', 'sector_id']);
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
