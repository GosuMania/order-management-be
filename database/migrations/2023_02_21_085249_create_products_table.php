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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_product_type')->unsigned();
            $table->bigInteger('id_color')->unsigned();
            $table->bigInteger('id_size')->unsigned();
            $table->integer('stock')->default(0);
            $table->dateTime('date');
        });

        Schema::table('products', function ($table) {
            $table->foreign('id_product_type')->references('id')->on('product_types')->onUpdate('cascade');
        });

        Schema::table('products', function ($table) {
            $table->foreign('id_color')->references('id')->on('colors')->onUpdate('cascade');
        });

        Schema::table('products', function ($table) {
            $table->foreign('id_size')->references('id')->on('sizes')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
