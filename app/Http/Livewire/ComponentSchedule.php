<?php

namespace App\Http\Livewire;

use App\Models\Schedule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class ComponentSchedule extends Component
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
    public $schedule_id;

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
    }
    
    public function render()
    {
        $Query = Schedule::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('date', 'like', '%' . $this->search . '%');
        }
        $schedules = $Query->where('indicator_id', $this->indicator->id)->orderBy('id', 'DESC')->paginate(7);
        return view('livewire.component-schedule', compact('schedules'));
    }

    public function store()
    {
        $this->validate();

        $schedule = new Schedule();        
        $schedule->indicator_id = $this->indicator->id;
        $schedule->date = $this->date;
        $schedule->description = $this->description;
        $schedule->save();

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->schedule_id = $id;
        
        $schedule = Schedule::find($id);
        
        $this->date = $schedule->date;
        $this->description = $schedule->description;

        $this->activity = "edit";
    }

    public function update()
    {
        $schedule = Schedule::find($this->schedule_id);

        $this->validate();

        $schedule->date = $this->date;
        $schedule->description = $this->description;
        $schedule->save();
        
        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->schedule_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $schedule = Schedule::find($this->schedule_id);
        $schedule->delete();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['date', 'description', 'schedule_id']);
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
