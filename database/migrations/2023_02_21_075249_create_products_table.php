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
            $table->bigInteger('id_product_type')->unsigned();
            $table->string('immagine');
            $table->string('codice_articolo');
            $table->string('descrizione_articolo');
            $table->string('prezzo');
            $table->dateTime('date');
        });
        Schema::table('products', function ($table) {
            $table->foreign('id_provider')->references('id')->on('providers')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('products', function ($table) {
            $table->foreign('id_product_type')->references('id')->on('product_types')->onUpdate('cascade')->onDelete('cascade');
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
