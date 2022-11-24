<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\District;
use App\Models\Municipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'Beni',
            'Chuquisaca',
            'Cochabamba',
            'La Paz',
            'Oruro',
            'Pando',
            'Potosí',
            'Santa Cruz',
            'Tarija',
            'Nacional'
        ];

        foreach ($departments as $department) {
            $data1 = Department::create(['name' => $department]);
            if ($data1->id < 10) {
                for ($i = 1; $i <= 50; $i++) {
                    $data2 = Municipality::create([
                        'department_id' => $data1->id,
                        'name' => "municipio" . " " . $data1->name . " " . $i
                    ]);
                    for ($j = 1; $j <= 30; $j++) {
                        $data3 = District::create([
                            'municipality_id' => $data2->id,
                            'name' => "distrito" . " " . $data2->name . " " . $j
                        ]);
                    }
                }
            } else {
                $data2 = Municipality::create([
                    'department_id' => $data1->id,
                    'name' => "Multimunicipal"
                ]);

                $data3 = District::create([
                    'municipality_id' => $data2->id,
                    'name' => "Multidistrital"
                ]);
            }
        }
    }
}
