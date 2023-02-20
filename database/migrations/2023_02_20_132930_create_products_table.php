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
            $table->string('immagine');
            $table->string('fornitore');
            $table->string('codice_articolo');
            $table->string('descrizione_articolo');
            $table->string('taglia');
            $table->bigInteger('id_colore')->unsigned()->nullable();
            $table->string('prezzo');
            $table->string('quantita_magazzino');
            $table->string('quantita_disponibile');
            $table->dateTime('date');
        });

        Schema::table('products', function ($table) {
            $table->foreign('id_colore')->references('id')->on('colors')->onUpdate('cascade');
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
