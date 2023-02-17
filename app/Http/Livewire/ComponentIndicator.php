<?php

namespace App\Http\Livewire;

use App\Models\Action;
use App\Models\Goal;
use App\Models\Indicator;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentIndicator extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $planning;

    public $activity;
    public $iteration;
    public $search;

    
    public $description;
    public $formula;
    public $year;
    public $ending;
    public $base_line;
    public $worth;
    public $measure;
    public $indicator_id;

    public $goals;
    public $actions;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'description' => 'required',
        'formula' => 'required',
        'year' => 'required',
        'ending' => 'required',
        'base_line' => 'required|max:200',
        'worth' => 'required|max:200',
        'measure' => 'required|max:200',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }
    
    public function render()
    {
        $Query = Indicator::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('description', 'like', '%' . $this->search . '%');
        }
        $indicators = $Query->where('planning_id', $this->planning->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-indicator', compact('indicators'));
    }

    public function store()
    {
        $this->validate();

        $indicator = new Indicator();
        $indicator->planning_id = $this->planning->id;
        $indicator->description = $this->description;
        $indicator->formula = $this->formula;
        $indicator->year = $this->year;
        $indicator->ending = $this->ending;
        $indicator->base_line = $this->base_line;
        $indicator->worth = $this->worth;
        $indicator->measure = $this->measure;
        $indicator->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->indicator_id = $id;
        
        $indicator = Indicator::find($id);

        $this->description = $indicator->description;
        $this->formula = $indicator->formula;
        $this->year = $indicator->year;
        $this->ending = $indicator->ending;
        $this->base_line = $indicator->base_line;
        $this->worth = $indicator->worth;
        $this->measure = $indicator->measure;

        $this->activity = "edit";
    }

    public function update()
    {
        $indicator = Indicator::find($this->indicator_id);

        $this->validate();

        $indicator->description = $this->description;
        $indicator->formula = $this->formula;
        $indicator->year = $this->year;
        $indicator->ending = $this->ending;
        $indicator->base_line = $this->base_line;
        $indicator->worth = $this->worth;
        $indicator->measure = $this->measure;
        $indicator->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->indicator_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $indicator = Indicator::find($this->indicator_id);
        $indicator->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['description', 'formula', 'year', 'ending', 'base_line', 'worth', 'measure', 'indicator_id']);
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
