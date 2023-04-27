<?php

namespace App\Http\Livewire;

use App\Models\Pillar;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentPillar extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $name;
    public $description;
    public $pillar_id;

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
        $Query = Pillar::query()
        ->when($this->search, function($query){
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'DESC')->paginate(7);

        $pillars = $Query;
        return view('livewire.component-pillar', compact('pillars'));
    }

    public function store()
    {
        $this->validate();

        $pillar = new Pillar();
        $pillar->name = $this->name;
        $pillar->description = $this->description;
        $pillar->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->pillar_id = $id;
        
        $pillar = Pillar::find($id);
        
        $this->name = $pillar->name;
        $this->description = $pillar->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $pillar = Pillar::find($this->pillar_id);

        $this->validate();

        $pillar->name = $this->name;
        $pillar->description = $this->description;
        $pillar->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->pillar_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $pillar = Pillar::find($this->pillar_id);
        $pillar->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'description', 'pillar_id']);
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
