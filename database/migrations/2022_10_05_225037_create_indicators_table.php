<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planning_id');   
            $table->longText('description');
            $table->longText('formula');
            $table->string('year');
            $table->string('base_line');
            $table->string('ending');
            $table->string('worth');
            $table->string('measure');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('planning_id')->references('id')->on('plannings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicators');
    }
};
