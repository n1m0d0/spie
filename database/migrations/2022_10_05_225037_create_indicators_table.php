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
            $table->unsignedBigInteger('action_id');
            $table->unsignedBigInteger('goal_id');
            $table->string('name');
            $table->enum('type', [
                'type1',
                'type2'
            ]);
            $table->enum('measure', [
                'measure1',
                'measure2'
            ]);
            $table->string('formula');
            $table->string('periodicity');
            $table->tinyText('description');
            $table->string('source_of_information');
            $table->string('base_line');
            $table->tinyText('strategic_theme');
            $table->timestamps();

            $table->foreign('goal_id')->references('id')->on('goals');
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
