<?php

namespace App\Http\Livewire;

use App\Models\Entity;
use Livewire\Component;

class ComponentReportIndicator extends Component
{
    public function render()
    {
        $entities = Entity::all();
        return view('livewire.component-report-indicator', compact('entities'));
    }
}
