<?php

namespace App\Http\Livewire;

use App\Models\Record;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentRecord extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $diagnostic;

    public $activity;
    public $iteration;
    public $search;

    public $date;
    public $worth;
    public $record_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'date' => 'required|max:200',
        'worth' => 'required|decimal:0,2',
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }

    public function render()
    {
        $Query = Record::query()
            ->when($this->search, function ($query) {
                $query->where('date', 'like', '%' . $this->search . '%');
            });

        $records = $Query->where('diagnostic_id', $this->diagnostic->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-record', compact('records'));
    }

    public function store()
    {
        $this->validate();

        $record = new Record();
        $record->diagnostic_id = $this->diagnostic->id;
        $record->date = $this->date;
        $record->worth = $this->worth;
        $record->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->record_id = $id;

        $record = Record::find($id);

        $this->date = $record->date;
        $this->worth = $record->worth;

        $this->activity = "edit";
    }

    public function update()
    {
        $record = Record::find($this->record_id);

        $this->validate();

        $record->date = $this->date;
        $record->worth = $this->worth;
        $record->save();

        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->record_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $record = Record::find($this->record_id);
        $record->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['date', 'worth', 'record_id']);
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
