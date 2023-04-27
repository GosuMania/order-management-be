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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_product')->unsigned();
            $table->bigInteger('id_product_type')->unsigned();
            $table->bigInteger('id_color')->unsigned();
            $table->bigInteger('id_clothing_size')->unsigned()->nullable();
            $table->bigInteger('id_clothing_number_size')->unsigned()->nullable();
            $table->bigInteger('id_shoe_size')->unsigned()->nullable();
            $table->integer('stock')->default(0);
            $table->dateTime('date');
        });

        Schema::table('product_variants', function ($table) {
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_product_type')->references('id')->on('product_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_color')->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_clothing_size')->references('id')->on('clothing_sizes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_clothing_number_size')->references('id')->on('clothing_number_sizes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_shoe_size')->references('id')->on('shoe_sizes')->onDelete('cascade')->onUpdate('cascade');
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
