<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;

class ComponentReportMunicipality extends Component
{
    public function render()
    {
        $departments = Department::all();
        return view('livewire.component-report-municipality', compact('departments'));
    }
}
