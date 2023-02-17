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
        Schema::create('consolidateds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('finance_id');
            $table->string('date');
            $table->float('budget', 20, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('finance_id')->references('id')->on('finances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consolidateds');
    }
};
