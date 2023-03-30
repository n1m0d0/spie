<?php

namespace App\Http\Livewire;

use App\Models\Entity;
use Livewire\Component;

class ComponentReportIndicator extends Component
{
    public function render()
    {
        $entities = Entity::all();

        $indicatorPerEntity = [];

        foreach ($entities as $entity) {
            $aux = 0;            
            $indicatorPerEntity['label'][] = $entity->acronym;
            foreach ($entity->plannings as $planning) {
                $aux = $aux + $planning->indicators->count();
            }
            $indicatorPerEntity['amount'][] = $aux;
        }

        $indicatorPerEntity = json_encode($indicatorPerEntity);

        return view('livewire.component-report-indicator', compact('entities', 'indicatorPerEntity'));
    }
}
