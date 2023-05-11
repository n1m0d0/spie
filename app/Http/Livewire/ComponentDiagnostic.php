<?php

namespace App\Http\Livewire;

use App\Models\Diagnostic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentDiagnostic extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $approach;

    public $activity;
    public $iteration;
    public $search;

    public $indicator;
    public $description;
    public $year;
    public $measure;

    public $diagnostic_id;

    public $sectors;
    public $types;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'indicator' => 'required|max:2500',
        'description' => 'required|max:2500',        
        'year' => 'required|max:200',        
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
        $Query = Diagnostic::query()
        ->when($this->search, function($query){
            $query->where('indicator', 'like', '%' . $this->search . '%');
        })
        ->where('approach_id', $this->approach->id)->orderBy('id', 'DESC')->paginate(7);
        
        $diagnostics = $Query;
        return view('livewire.component-diagnostic', compact('diagnostics'));
    }

    public function store()
    {
        $this->validate();

        $diagnostic = new Diagnostic();
        $diagnostic->approach_id = $this->approach->id;
        $diagnostic->indicator = $this->indicator;
        $diagnostic->description = $this->description;
        $diagnostic->year = $this->year;        
        $diagnostic->measure = $this->measure;
        $diagnostic->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->diagnostic_id = $id;

        $diagnostic = Diagnostic::find($id);

        $this->indicator = $diagnostic->indicator;
        $this->description = $diagnostic->description;
        $this->year = $diagnostic->year;
        $this->measure = $diagnostic->measure;

        $this->activity = "edit";
    }

    public function update()
    {
        $diagnostic = Diagnostic::find($this->diagnostic_id);

        $this->validate();

        $diagnostic->indicator = $this->indicator;
        $diagnostic->description = $this->description;
        $diagnostic->year = $this->year;        
        $diagnostic->measure = $this->measure;
        $diagnostic->save();

        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->diagnostic_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $diagnostic = Diagnostic::find($this->diagnostic_id);
        $diagnostic->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['indicator', 'description', 'year', 'measure', 'diagnostic_id']);
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
