<?php

namespace App\Http\Livewire;

use App\Models\Hub;
use Livewire\Component;

class ComponentReportActor extends Component
{
    public function render()
    {
        $hubs = Hub::all();
        foreach ($hubs as $hub) {
            $entities = collect();
            foreach ($hub->goals as $goal) {
                foreach ($goal->results as $result) {
                    foreach ($result->actions as $action) {
                        foreach($action->plannings as $planning)
                        {
                            $entities->push($planning->entity->acronym);
                        }
                    }
                }
            }

            $hub->entities = $entities->unique();
        }
        return view('livewire.component-report-actor', compact('hubs'));
    }
}
