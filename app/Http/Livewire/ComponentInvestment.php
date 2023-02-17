<?php

namespace App\Http\Livewire;

use App\Models\Investment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentInvestment extends Component
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
    public $investment_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'date' => 'required|max:200',
        'budget' => 'required|max:200'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }
    
    public function render()
    {
        $Query = Investment::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('date', 'like', '%' . $this->search . '%');
        }
        $investments = $Query->where('finance_id', $this->finance->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-investment', compact('investments'));
    }

    public function store()
    {
        $this->validate();

        $investment = new Investment();        
        $investment->finance_id = $this->finance->id;
        $investment->date = $this->date;
        $investment->budget = $this->budget;
        $investment->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->investment_id = $id;
        
        $investment = Investment::find($id);
        
        $this->date = $investment->date;
        $this->budget = $investment->budget;

        $this->activity = "edit";
    }

    public function update()
    {
        $investment = Investment::find($this->investment_id);

        $this->validate();

        $investment->date = $this->date;
        $investment->budget = $this->budget;
        $investment->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->investment_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $investment = Investment::find($this->investment_id);
        $investment->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['date', 'budget', 'investment_id']);
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
