<?php

namespace App\Http\Livewire;

use App\Models\Frequency;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentFrequency extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $indicator;

    public $activity;
    public $iteration;
    public $search;

    public $date;
    public $description;
    public $frequency_id;

    public $continuity;

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
        $this->continuity = false;
    }
    
    public function render()
    {
        $Query = Frequency::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('date', 'like', '%' . $this->search . '%');
        }
        $frequencies = $Query->where('indicator_id', $this->indicator->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-frequency', compact('frequencies'));
    }

    public function store()
    {
        $this->validate();

        $frequency = new Frequency();        
        $frequency->indicator_id = $this->indicator->id;
        $frequency->date = $this->date;
        $frequency->description = $this->description;
        $frequency->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->frequency_id = $id;
        
        $frequency = Frequency::find($id);
        
        $this->date = $frequency->date;
        $this->description = $frequency->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $frequency = Frequency::find($this->frequency_id);

        $this->validate();

        $frequency->date = $this->date;
        $frequency->description = $this->description;
        $frequency->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->frequency_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $frequency = Frequency::find($this->frequency_id);
        $frequency->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['date', 'description', 'frequency_id']);
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
