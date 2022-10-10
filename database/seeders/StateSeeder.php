<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state = new State();
        $state->name = "Activo";
        $state->description = "Usuario Vigente del sistema";
        $state->save();

        $state = new State();
        $state->name = "Inactivo";
        $state->description = "Usuario que no puede ingresar al sistema";
        $state->save();
    }
}
