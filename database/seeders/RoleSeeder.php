<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin',
            'creador',
            'validador',
            'creador territorial'
        ];

        foreach ($roles as $role) {
            $data = Role::create(['name' => $role]);
        }
    }
}
