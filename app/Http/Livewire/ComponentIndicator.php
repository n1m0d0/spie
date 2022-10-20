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

    public $activity;
    public $iteration;
    public $search;

    public $goal_id;
    public $action_id;
    public $name;
    public $description;
    public $type;
    public $measure;
    public $formula;
    public $periodicity;
    public $source_of_information;
    public $base_line;
    public $strategic_theme;
    public $indicator_id;

    public $goals;
    public $actions;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'goal_id' => 'required',
        'action_id' => 'required',
        'name' => 'required|max:200',
        'description' => 'required|max:200',
        'type' => 'required',
        'measure' => 'required',
        'formula' => 'required|max:200',
        'periodicity' => 'required|max:200',
        'source_of_information' => 'required|max:200',
        'base_line' => 'required|max:200',
        'strategic_theme' => 'required|max:200',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
        $this->goals = Goal::all();
        $this->actions = Action::all();
    }
    
    public function render()
    {
        $Query = Indicator::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $indicators = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-indicator', compact('indicators'));
    }

    public function store()
    {
        $this->validate();

        $indicator = new Indicator();
        $indicator->goal_id = $this->goal_id;
        $indicator->action_id = $this->action_id;
        $indicator->name = $this->name;
        $indicator->description = $this->description;
        $indicator->type = $this->type;
        $indicator->measure = $this->measure;
        $indicator->formula = $this->formula;
        $indicator->periodicity = $this->periodicity;
        $indicator->source_of_information = $this->source_of_information;
        $indicator->base_line = $this->base_line;
        $indicator->strategic_theme = $this->strategic_theme;
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
        
        $this->goal_id = $indicator->goal_id;
        $this->action_id = $indicator->action_id;
        $this->name = $indicator->name;
        $this->description = $indicator->description;
        $this->type = $indicator->type;
        $this->measure = $indicator->measure;
        $this->formula = $indicator->formula;
        $this->periodicity = $indicator->periodicity;
        $this->source_of_information = $indicator->source_of_information;
        $this->base_line = $indicator->base_line;
        $this->strategic_theme = $indicator->strategic_theme;

        $this->activity = "edit";
    }

    public function update()
    {
        $indicator = Indicator::find($this->indicator_id);

        $this->validate();

        $indicator->goal_id = $this->goal_id;
        $indicator->action_id = $this->action_id;
        $indicator->name = $this->name;
        $indicator->description = $this->description;
        $indicator->type = $this->type;
        $indicator->measure = $this->measure;
        $indicator->formula = $this->formula;
        $indicator->periodicity = $this->periodicity;
        $indicator->source_of_information = $this->source_of_information;
        $indicator->base_line = $this->base_line;
        $indicator->strategic_theme = $this->strategic_theme;
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
        $this->reset(['goal_id', 'action_id', 'name', 'description', 'type', 'measure', 'formula', 'periodicity', 'source_of_information', 'base_line', 'strategic_theme', 'indicator_id']);
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
