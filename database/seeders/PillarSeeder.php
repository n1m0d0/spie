<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Goal;
use App\Models\Hub;
use App\Models\Pillar;
use App\Models\Result;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PillarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $data1 = Pillar::create([
                'name' => "pilar" . " " . $i,
                'description' => "descripcion" . " " . $i
            ]);
            for ($j = 1; $j <= 5; $j++) {
                $data2 = Hub::create([
                    'pillar_id' => $data1->id,
                    'name' => "eje" . " " . $j . " " . $data1->name,
                    'description' => "descripcion" . " " . $j
                ]);
                for ($k = 1; $k <= 5; $k++) {
                    $data3 = Goal::create([
                        'hub_id' => $data2->id,
                        'name' => "meta" . " " . $k . " " . $data2->name,
                        'description' => "descripcion" . " " . $k
                    ]);
                    for ($l = 1; $l <= 5; $l++) {
                        $data4 = Result::create([
                            'goal_id' => $data3->id,
                            'name' => "resultado" . " " . $l . " " . $data3->name,
                            'description' => "descripcion" . " " . $l
                        ]);
                        for ($m = 1; $m <= 5; $m++) {
                            Action::create([
                                'result_id' => $data4->id,
                                'name' => "accion" . " " . $m . " " . $data4->name,
                                'description' => "descripcion" . " " . $m
                            ]);
                        }
                    }
                }
            }
        }
    }
}
