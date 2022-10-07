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
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hub_id')->nullable();
            $table->unsignedBigInteger('result_id')->nullable();
            $table->unsignedBigInteger('goal_id')->nullable();
            $table->string('name');
            $table->tinyText('description');
            $table->timestamps();

            $table->foreign('hub_id')->references('id')->on('hubs');
            $table->foreign('result_id')->references('id')->on('results');
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
        Schema::dropIfExists('actions');
    }
};
