<?php

namespace App\Http\Livewire;

use App\Models\Current;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentCurrent extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $finance;

    public $activity;
    public $iteration;
    public $search;

    public $date;
    public $description;
    public $current_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'date' => 'required|max:200',
        'description' => 'required|max:200'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }
    
    public function render()
    {
        $Query = Current::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('date', 'like', '%' . $this->search . '%');
        }
        $currents = $Query->where('finance_id', $this->finance->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-current', compact('currents'));
    }

    public function store()
    {
        $this->validate();

        $current = new Current();        
        $current->finance_id = $this->finance->id;
        $current->date = $this->date;
        $current->description = $this->description;
        $current->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->current_id = $id;
        
        $current = Current::find($id);
        
        $this->date = $current->date;
        $this->description = $current->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $current = Current::find($this->current_id);

        $this->validate();

        $current->date = $this->date;
        $current->description = $this->description;
        $current->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->current_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $current = Current::find($this->current_id);
        $current->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['date', 'description', 'current_id']);
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