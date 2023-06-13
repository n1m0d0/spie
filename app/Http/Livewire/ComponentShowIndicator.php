<?php

namespace App\Http\Livewire;

use App\Models\Indicator;
use App\Models\Planning;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentShowIndicator extends Component
{
    use WithPagination;
    use WireToast;

    public $search;

    public $planning;

    public $indicator_id;

    public $type_id;

    public $types;

    public $addModalType;
    public $deleteTypeModal;

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

    public function mount(Planning $planning)
    {
        $this->planning = $planning;
        $this->types = Type::all();
        $this->addModalType = false;
        $this->deleteTypeModal = false;
    }

    public function render()
    {
        $Query = Indicator::query()
            ->when($this->search, function ($query) {
                $query->where('description', 'like', '%' . $this->search . '%');
            });
        $indicators = $Query->where('planning_id', $this->planning->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-show-indicator', compact('indicators'));
    }

    public function modalAddType($id)
    {
        $this->indicator_id = $id;

        $this->addModalType = true;
    }

    public function addType()
    {
        $this->validate([
            'type_id' => 'required'
        ]);

        $indicator = Indicator::find($this->indicator_id);
        $indicator->types()->attach($this->type_id);

        $this->addModalType = false;
        $this->clear();
        toast()
            ->success('Se añadido correctamente')
            ->push();
    }

    public function modalDeleteType($id, $idType)
    {
        $this->indicator_id = $id;
        $this->type_id = $idType;

        $this->deleteTypeModal = true;
    }

    public function deleteType()
    {
        $indicator = Indicator::find($this->indicator_id);
        $indicator->types()->detach($this->type_id);

        $this->deleteTypeModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['indicator_id', 'type_id']);

    }
}
