<?php

namespace App\Http\Livewire;

use App\Models\Hub;
use Livewire\Component;

class ComponentReportHub extends Component
{
    public function render()
    {
        $hubs = Hub::all();

        $goalPerAxis = [];
        $resultPerAxis = [];
        $actionPerAxis = [];
        $planningPerAxis = [];

        foreach ($hubs as $hub) {
            $goalPerAxis['label'][] = "Eje-" . $hub->name;
            $goalPerAxis['amount'][] = $hub->goals->count();
        }

        $goalPerAxis = json_encode($goalPerAxis);

        foreach ($hubs as $hub) {
            $aux = 0;
            $resultPerAxis['label'][] = "Eje-" . $hub->name;
            foreach ($hub->goals as $goal) {
                $aux = $aux + $goal->results->count();
            }
            $resultPerAxis['amount'][] = $aux;
        }

        $resultPerAxis = json_encode($resultPerAxis);

        foreach ($hubs as $hub) {
            $aux = 0;
            $actionPerAxis['label'][] = "Eje-" . $hub->name;
            foreach ($hub->goals as $goal) {
                foreach ($goal->results as $result) {
                    $aux = $aux + $result->actions->count();
                }
            }
            $actionPerAxis['amount'][] = $aux;
        }

        $actionPerAxis = json_encode($actionPerAxis);

        foreach ($hubs as $hub) {
            $aux = 0;
            $planningPerAxis['label'][] = "Eje-" . $hub->name;
            foreach ($hub->goals as $goal) {
                foreach ($goal->results as $result) {
                    foreach ($result->actions as $action)
                    {
                        $aux = $aux + $action->plannings->count();
                    }
                }
            }
            $planningPerAxis['amount'][] = $aux;
        }

        $planningPerAxis = json_encode($planningPerAxis);

        return view('livewire.component-report-hub', compact('hubs', 'goalPerAxis', 'resultPerAxis', 'actionPerAxis', 'planningPerAxis'));
    }
}
