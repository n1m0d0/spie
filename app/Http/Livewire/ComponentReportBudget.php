<?php

namespace App\Http\Livewire;

use App\Models\Finance;
use App\Models\Hub;
use Livewire\Component;
use PhpParser\Node\Stmt\Foreach_;

class ComponentReportBudget extends Component
{
    public function render()
    {
        $hubs = Hub::all();
        $budgetperaxis = [];

        //$goalPerAxis['amount'][] = $hub->goals->count();
        foreach ($hubs as $hub) {
            $aux = 0;
            $budgetperaxis['label'][] = "Eje-" . $hub->name;
            foreach ($hub->goals as $goal) {
                foreach ($goal->results as $result) {
                    foreach ($result->actions as $action) {
                        foreach ($action->plannings as $planning) {
                            foreach($planning->finances as $finance){
                                $aux = $aux + $finance->budget;
                            }
                        }
                    }
                }
            }
            $budgetperaxis['amount'][] = $aux;
        }

        $budgetperaxis = json_encode($budgetperaxis);

        return view('livewire.component-report-budget', compact('hubs', 'budgetperaxis'));
    }
}
