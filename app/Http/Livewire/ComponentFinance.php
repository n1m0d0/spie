<?php

namespace App\Http\Livewire;

use App\Models\Finance;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentFinance extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $planning;

    public $activity;
    public $iteration;
    public $search;

    public $programmatic_category;
    public $budget;
    public $finance_id;

    public $visibility;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'programmatic_category' => 'required|max:200',
        'budget' => 'required|decimal:0,2',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->visibility = false;

        foreach($this->planning->types as $type)
        {
            if($type->id == 9 || $type->id == 10 || $type->id == 11)
            {
                $this->visibility = true;
            }
        }
    }

    public function render()
    {
        $Query = Finance::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('programmatic_category', 'like', '%' . $this->search . '%');
        }
        $finances = $Query->where('planning_id', $this->planning->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-finance', compact('finances'));
    }

    public function store()
    {
        $this->validate();

        $finance = new Finance();        
        $finance->planning_id = $this->planning->id;
        $finance->programmatic_category = $this->programmatic_category;
        $finance->budget = $this->budget;
        $finance->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->finance_id = $id;
        
        $finance = Finance::find($id);
        
        $this->programmatic_category = $finance->programmatic_category;
        $this->budget = $finance->budget;

        $this->activity = "edit";
    }

    public function update()
    {
        $finance = Finance::find($this->finance_id);

        $this->validate();

        $finance->programmatic_category = $this->programmatic_category;
        $finance->budget = $this->budget;
        $finance->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->finance_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $finance = Finance::find($this->finance_id);
        $finance->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['programmatic_category', 'budget', 'finance_id']);
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
