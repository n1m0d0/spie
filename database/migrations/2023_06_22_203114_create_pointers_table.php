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
        Schema::create('pointers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aim_id');
            $table->string('code');
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('aim_id')->references('id')->on('aims');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pointers');
    }
};
