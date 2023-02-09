<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            EntitySeeder::class,
            StateSeeder::class,
            //MeasureSeeder::class,
            //TypeSeeder::class,
            //SectorSeeder::class,
            //PillarSeeder::class,
            //DepartmentSeeder::class,
            UserSeeder::class,
        ]);
    }
}
