<?php

namespace Database\Seeders;

use App\Models\Measure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $measure = new Measure();
        $measure->name = "medida1";
        $measure->save();

        $measure = new Measure();
        $measure->name = "medida2";
        $measure->save();

        $measure = new Measure();
        $measure->name = "medida3";
        $measure->save();

        $measure = new Measure();
        $measure->name = "medida4";
        $measure->save();

        $measure = new Measure();
        $measure->name = "medida5";
        $measure->save();

        $measure = new Measure();
        $measure->name = "medida6";
        $measure->save();
    }
}
