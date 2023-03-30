<?php

namespace App\Http\Livewire;

use App\Models\Action;
use App\Models\Hub;
use Livewire\Component;

class ComponentReportDictum extends Component
{
    public function render()
    {
        $hubs = Hub::all();
        return view('livewire.component-report-dictum', compact('hubs'));
    }
}
