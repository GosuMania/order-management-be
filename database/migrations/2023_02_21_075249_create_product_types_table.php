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
        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->string('immagine');
            $table->bigInteger('id_provider')->unsigned()->nullable();
            $table->string('codice_articolo');
            $table->string('descrizione_articolo');
            $table->string('prezzo');
            $table->dateTime('date');
        });

        Schema::table('product_types', function ($table) {
            $table->foreign('id_provider')->references('id')->on('providers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_products');
    }
};
