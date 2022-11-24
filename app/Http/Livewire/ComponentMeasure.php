<?php

namespace App\Http\Livewire;

use App\Models\Measure;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentMeasure extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $name;
    public $measure_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'name' => 'required|max:200',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }
    
    public function render()
    {
        $Query = Measure::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $measures = $Query->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-measure', compact('measures'));
    }

    public function store()
    {
        $this->validate();

        $measure = new Measure();
        $measure->name = $this->name;
        $measure->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->measure_id = $id;
        
        $measure = Measure::find($id);
        
        $this->name = $measure->name;

        $this->activity = "edit";
    }

    public function update()
    {
        $measure = Measure::find($this->measure_id);

        $this->validate();

        $measure->name = $this->name;
        $measure->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->measure_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $measure = Measure::find($this->measure_id);
        $measure->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['name', 'measure_id']);
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
