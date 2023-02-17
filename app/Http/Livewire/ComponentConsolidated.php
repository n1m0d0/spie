<?php

namespace App\Http\Livewire;

use App\Models\Consolidated;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentConsolidated extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $finance;

    public $activity;
    public $iteration;
    public $search;

    public $date;
    public $budget;
    public $consolidated_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'date' => 'required|max:200',
        'budget' => 'required|decimal:0,2',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }
    
    public function render()
    {
        $Query = Consolidated::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('date', 'like', '%' . $this->search . '%');
        }
        $consolidateds = $Query->where('finance_id', $this->finance->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-consolidated', compact('consolidateds'));
    }

    public function store()
    {
        $this->validate();

        $consolidated = new Consolidated();        
        $consolidated->finance_id = $this->finance->id;
        $consolidated->date = $this->date;
        $consolidated->budget = $this->budget;
        $consolidated->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->consolidated_id = $id;
        
        $consolidated = Consolidated::find($id);
        
        $this->date = $consolidated->date;
        $this->budget = $consolidated->budget;

        $this->activity = "edit";
    }

    public function update()
    {
        $consolidated = Consolidated::find($this->consolidated_id);

        $this->validate();

        $consolidated->date = $this->date;
        $consolidated->budget = $this->budget;
        $consolidated->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->consolidated_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $consolidated = Consolidated::find($this->consolidated_id);
        $consolidated->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['date', 'budget', 'consolidated_id']);
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
