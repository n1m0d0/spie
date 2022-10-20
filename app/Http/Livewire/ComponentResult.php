<?php

namespace App\Http\Livewire;

use App\Models\Result;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentResult extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $name;
    public $description;
    public $result_id;

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
        $Query = Result::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $results = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-result', compact('results'));
    }

    public function store()
    {
        $this->validate();

        $result = new Result();
        $result->name = $this->name;
        $result->description = $this->description;
        $result->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->result_id = $id;
        
        $result = Result::find($id);
        
        $this->name = $result->name;
        $this->description = $result->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $result = Result::find($this->result_id);

        $this->validate();

        $result->name = $this->name;
        $result->description = $this->description;
        $result->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->result_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $result = Result::find($this->result_id);
        $result->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'description', 'result_id']);
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
