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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_season_type')->unsigned();
            $table->string('desc_season_type');
            $table->integer('year');
            $table->dateTime('startDate');
            $table->dateTime('finalDate');
        });

        Schema::table('seasons', function ($table) {
            $table->foreign('id_season_type')->references('id')->on('season_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
    }
};
