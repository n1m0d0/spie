<?php

namespace App\Http\Livewire;

use App\Models\Hub;
use App\Models\Pillar;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentHub extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $name;
    public $description;
    public $hub_id;

    public $pillar_id;
    public $pillars;

    public $deleteModal;
    public $addModal;
    public $deletePillarModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200',
        'description' => 'required|max:200'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->addModal = false;
        $this->deletePillarModal = false;
        $this->pillars = Pillar::all();
    }
    
    public function render()
    {
        $Query = Hub::query()
        ->when($this->search, function($query){
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'DESC')->paginate(7);
        
        $hubs = $Query;
        return view('livewire.component-hub', compact("hubs"));
    }

    public function store()
    {
        $this->validate();

        $hub = new Hub();
        $hub->name = $this->name;
        $hub->description = $this->description;
        $hub->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->hub_id = $id;
        
        $hub = hub::find($id);
        
        $this->name = $hub->name;
        $this->description = $hub->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $hub = hub::find($this->hub_id);

        $this->validate();

        $hub->name = $this->name;
        $hub->description = $this->description;
        $hub->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->hub_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $hub = hub::find($this->hub_id);
        $hub->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function modalAdd($id)
    {
        $this->hub_id = $id;

        $this->addModal = true;
    }

    public function add()
    {
        $this->validate([
            'pillar_id' => 'required'
        ]);

        $hub = hub::find($this->hub_id);
        $hub->pillars()->attach($this->pillar_id);

        $this->addModal = false;
        $this->clear();
        toast()
            ->success('Se añadido correctamente')
            ->push();
    }

    public function modalDeletePillar($id, $idPillar)
    {
        $this->hub_id = $id;
        $this->pillar_id = $idPillar;

        $this->deletePillarModal = true;
    }

    public function deletePillar()
    {
        $hub = hub::find($this->hub_id);
        $hub->pillars()->detach($this->pillar_id);

        $this->deletePillarModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'description', 'hub_id', 'pillar_id']);
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
