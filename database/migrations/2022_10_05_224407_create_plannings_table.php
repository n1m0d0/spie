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
        Schema::create('plannings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planning_id')->nullable();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('action_id');
            $table->unsignedBigInteger('sector_id');
            $table->unsignedBigInteger('entity_id');
            $table->string('code');
            $table->longText('result_description');
            $table->longText('action_description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('action_id')->references('id')->on('actions');
            $table->foreign('sector_id')->references('id')->on('sectors');
            $table->foreign('entity_id')->references('id')->on('entities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plannings');
    }
};
