<?php

namespace App\Http\Livewire;

use App\Models\Indicator;
use App\Models\Pointer;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentMatch extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $iteration;
    public $search;
    public $searchIndicator;

    public $indicator_id;
    public $pointer_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }

    public function render()
    {
        $indicators = Indicator::query()
        ->when($this->searchIndicator, function($query){
            $query->where('description', 'like', '%' . $this->searchIndicator . '%');
        })
        ->whereHas('types', function($query) {
            $query->where('type_id', 2);
        })
        ->orderBy('id', 'DESC')->get();

        $pointers = Pointer::query()
        ->when($this->searchIndicator, function($query){
            $query->where('description', 'like', '%' . $this->searchIndicator . '%');
        })
        ->orderBy('id', 'DESC')->get();

        $relations = Pointer::query()
        ->when($this->search, function($query){
            $query->where('description', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'DESC')->paginate(20);

        return view('livewire.component-match', compact('indicators', 'pointers', 'relations'));
    }

    public function selectIndicator($id)
    {
        $this->indicator_id = $id;
    }

    public function selectPointer($id)
    {
        $this->pointer_id = $id;
    }

    public function store()
    {
        $this->validate([
            'pointer_id' => 'required',
            'indicator_id' => 'required'
        ]);

        $pointer = Pointer::find($this->pointer_id);
        $pointer->indicators()->attach($this->indicator_id);

        $this->clear();
        toast()
            ->success('Se añadido correctamente')
            ->push();
    }

    public function modalDelete($id, $indicator_id)
    {
        $this->pointer_id = $id;
        $this->indicator_id = $indicator_id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $pointer = Pointer::find($this->pointer_id);
        $pointer->indicators()->detach($this->indicator_id);

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['pointer_id', 'indicator_id']);
        $this->iteration++;
        $this->resetSearchIndicator();
    }

    public function resetSearch()
    {
        $this->reset(['search']);
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetSearchIndicator()
    {
        $this->reset(['searchIndicator']);
        $this->indicator_id = null;
        $this->pointer_id = null;
        $this->resetPage();
    }

    public function updatingSearchIndicator()
    {
        $this->resetPage();
    }
}
