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
        Schema::create('dissociation_indicator', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dissociation_id');
            $table->unsignedBigInteger('indicator_id');
            $table->timestamps();   

            $table->foreign('dissociation_id')->references('id')->on('dissociations');
            $table->foreign('indicator_id')->references('id')->on('indicators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dissociation_indicator');
    }
};
