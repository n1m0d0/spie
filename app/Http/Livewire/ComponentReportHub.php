<?php

namespace App\Http\Livewire;

use App\Models\Hub;
use Livewire\Component;

class ComponentReportHub extends Component
{
    public function render()
    {
        $hubs = Hub::all();
        return view('livewire.component-report-hub', compact('hubs'));
    }
}
