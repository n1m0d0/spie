<?php

namespace App\Http\Livewire;

use App\Models\Approach;
use App\Models\Sector;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentApproach extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $entity_id;
    public $sector_id;
    public $type_id;
    public $description;

    public $approach_id;

    public $sectors;
    public $types;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'sector_id' => 'required',
        'type_id' => 'required',
        'description' => 'required|max:2500'
    ];

    public function mount()
    {
        $this->entity_id = auth()->user()->entity_id;
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;

        $this->sectors = Sector::all();
        $this->types = Type::all();
    }

    public function render()
    {
        $Query = Approach::query()
        ->when($this->search, function($query){
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->where('entity_id', $this->entity_id)->orderBy('id', 'DESC')->paginate(7);
        
        $approaches = $Query;
        return view('livewire.component-approach', compact('approaches'));
    }

    public function store()
    {
        $this->validate();

        $approach = new Approach();
        $approach->entity_id = $this->entity_id;
        $approach->sector_id = $this->sector_id;
        $approach->type_id = $this->type_id;
        $approach->description = $this->description;
        $approach->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->approach_id = $id;

        $approach = Approach::find($id);

        $this->sector_id = $approach->sector_id;
        $this->type_id = $approach->type_id;
        $this->description = $approach->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $approach = Approach::find($this->approach_id);

        $this->validate();

        $approach->sector_id = $this->sector_id;
        $approach->type_id = $this->type_id;
        $approach->description = $this->description;
        $approach->save();

        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->approach_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $approach = Approach::find($this->approach_id);
        $approach->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['sector_id', 'type_id', 'description', 'approach_id']);
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
