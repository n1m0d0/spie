<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new Type();
        $type->name = "tipo1";
        $type->description = "descripcion tipo1";
        $type->save();

        $type = new Type();
        $type->name = "tipo2";
        $type->description = "descripcion tipo2";
        $type->save();

        $type = new Type();
        $type->name = "tipo3";
        $type->description = "descripcion tipo3";
        $type->save();

        $type = new Type();
        $type->name = "tipo4";
        $type->description = "descripcion tipo4";
        $type->save();
    }
}
