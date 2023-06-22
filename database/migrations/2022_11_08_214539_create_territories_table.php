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
        Schema::create('territories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planning_id');
            $table->unsignedBigInteger('municipality_id');
            $table->enum('community', [
                "URBANO",
                "RURAL",
                "URBANO/RURAL"
            ]);
            $table->tinyText('district')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('planning_id')->references('id')->on('plannings');
            $table->foreign('municipality_id')->references('id')->on('municipalities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('territories');
    }
};
