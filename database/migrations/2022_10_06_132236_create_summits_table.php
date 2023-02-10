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
        Schema::create('summits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goal_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('organization_id');
            $table->date('date');
            $table->string('proposals');
            $table->tinyText('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('goal_id')->references('id')->on('goals');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('summits');
    }
};
