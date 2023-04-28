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
            $table->bigInteger('id_provider')->unsigned();
            $table->string('desc_provider');
            $table->bigInteger('id_product_type')->unsigned();
            $table->string('desc_product_type');
            $table->bigInteger('id_clothing_size_type')->unsigned()->default(1);
            $table->string('immagine')->nullable();
            $table->string('codice_articolo');
            $table->string('descrizione_articolo');
            $table->double('prezzo');
            $table->dateTime('date');
        });
        Schema::table('products', function ($table) {
            $table->foreign('id_provider')->references('id')->on('providers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_product_type')->references('id')->on('product_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_clothing_size_type')->references('id')->on('clothing_size_types')->onDelete('cascade')->onUpdate('cascade');
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
