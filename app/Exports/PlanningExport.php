<?php

namespace App\Exports;

use App\Models\Planning;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Excel;

class PlanningExport implements FromView, ShouldAutoSize, Responsable
{
    use Exportable;

    private $fileName = 'planning.xlsx';
    private $writerType = Excel::XLSX;

    private $search;
    private $sector_id;
    private $type_id;
    private $entity_id;

    private $resultQuery;
    private $indicator_type_id;

    /*public function __construct($search, $sector_id, $entity_id, $type_id)
    {
        $this->search = $search;
        $this->sector_id = $sector_id;
        $this->entity_id = $entity_id;
        $this->type_id = $type_id;
    }*/

    public function __construct($resultQuery, $indicator_type_id)
    {
        $this->resultQuery = $resultQuery;
        $this->indicator_type_id = $indicator_type_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        /*return view('exports.planning', [
            'plannings' => Planning::query()
                ->when($this->search, function ($query) {
                    $query->where('code', 'like', '%' . $this->search . '%')->orWhere('result_description', 'like', '%' . $this->search . '%')->orWhere('action_description', 'like', '%' . $this->search . '%');
                })
                ->when($this->sector_id, function ($query) {
                    $query->where('sector_id', $this->sector_id);
                })
                ->when($this->entity_id, function ($query) {
                    $query->where('entity_id', $this->entity_id);
                })
                ->when($this->type_id, function ($query) {
                    $query->whereHas('types', function ($query) {
                        $query->where('types.id', $this->type_id);
                    });
                })->get()
        ]);*/

        return view('exports.planning', [
            'plannings' => $this->resultQuery,
            'indicator_type_id' => $this->indicator_type_id
        ]);
    }
}
