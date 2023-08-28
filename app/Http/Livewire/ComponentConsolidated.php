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

    public $visibility;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'date' => 'required|max:200',
        'budget' => 'required|decimal:0,2|min:0',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;

        $this->visibility = false;
        foreach ($this->finance->planning->types as $type) {
            if ($type->id == 9 || $type->id == 10 || $type->id == 11) {
                $this->visibility = true;
            }
        }

        /*if ($consolidated->count() > 0) {
            
        } else {
            foreach ($this->finance->planning->types as $type) {
                if ($type->id == 9 || $type->id == 10 || $type->id == 11) {
                    $this->visibility = true;
                }
            }

            if ($this->visibility) {
                $auxInvestment = collect();
                $auxCurrent = collect();
                foreach ($this->finance->investments as $investment) {
                    $auxInvestment->push(["date" => $investment->date, "budget" => $investment->budget]);
                }

                foreach ($this->finance->currents as $current) {
                    $auxCurrent->push(["date" => $current->date, "budget" => $current->budget]);
                }

                $auxCurrent = $auxCurrent->unique('date');
                $auxInvestment = $auxInvestment->unique('date');

                $first = $auxCurrent->first();
                $last = $auxCurrent->last();
                $aux = collect();
                $aux = $auxInvestment->concat($auxCurrent);

                $filtered = $aux->where('date', "" . 2021);

                $filtered->all();

                for ($i = $first['date']; $i <= $last['date']; $i++) {
                    $filtered = $aux->where('date', "" . $i);
                    $sum = $filtered->sum('budget');
                    $consolidated = new Consolidated();
                    $consolidated->finance_id = $this->finance->id;
                    $consolidated->date = $i;
                    $consolidated->budget = $sum;
                    $consolidated->save();
                }
            }
        }*/
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

    public function generate()
    {
        $auxInvestment = collect();
        $auxCurrent = collect();
        foreach ($this->finance->investments as $investment) {
            $auxInvestment->push(["date" => $investment->date, "budget" => $investment->budget]);
        }

        foreach ($this->finance->currents as $current) {
            $auxCurrent->push(["date" => $current->date, "budget" => $current->budget]);
        }

        $auxCurrent = $auxCurrent->unique('date');
        $auxInvestment = $auxInvestment->unique('date');

        $firstInvestment = $auxInvestment->first();
        $lastInvestment = $auxInvestment->last();
        $firstCurrent = $auxCurrent->first();
        $lastCurrent = $auxCurrent->last();
        $aux = collect();
        $aux = $auxInvestment->concat($auxCurrent);

        if ($firstInvestment == null || $firstCurrent == null) {
            toast()
                ->warning('Se deben completar los registros previos')
                ->push();
        } else {
            $first = 0;
            $last = 0;
            if ($firstInvestment['date'] > $firstCurrent['date']) {
                $first = $firstCurrent['date'];
            } else {
                $first = $firstInvestment['date'];
            }

            if ($lastInvestment['date'] > $lastCurrent['date']) {
                $last = $lastInvestment['date'];
            } else {
                $last = $lastCurrent['date'];
            }

            for ($i = $first; $i <= $last; $i++) {
                $filtered = $aux->where('date', "" . $i);
                $sum = $filtered->sum('budget');
                $consolidated = new Consolidated();
                $consolidated->finance_id = $this->finance->id;
                $consolidated->date = $i;
                $consolidated->budget = $sum;
                $consolidated->save();
            }

            toast()
                ->success('Se genero correctamente')
                ->push();
        }
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
