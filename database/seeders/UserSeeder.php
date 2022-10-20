<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->entity_id = 5;
        $user->state_id = 1;
        $user->name = "admin";
        $user->paternal = "admin";
        $user->maternal = "admin";
        $user->identity = "0000000";
        $user->email = "admin@admin.com";
        $user->password = bcrypt("123456789");
        $user->save();

        $user->assignRole('admin');
    }
}
