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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id');
            $table->unsignedBigInteger('municipality_id');
            $table->unsignedBigInteger('indicator_id');
            $table->unsignedBigInteger('action_id');
            $table->string('code_sisin');
            $table->string('name');
            $table->string('geolocation');
            $table->enum('type', [
                'type1',
                'type2'
            ]);
            $table->enum('spent', [
                'spent1',
                'spent2'
            ]);
            $table->boolean('prioritized');
            $table->float('total_cost');
            $table->float('executed_amount');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('entity_id')->references('id')->on('entities');
            $table->foreign('municipality_id')->references('id')->on('municipalities');
            $table->foreign('indicator_id')->references('id')->on('indicators');
            $table->foreign('action_id')->references('id')->on('actions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
