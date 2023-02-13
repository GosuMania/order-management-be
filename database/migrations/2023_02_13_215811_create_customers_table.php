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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('ragione_sociale');
            $table->string('partiva_iva');
            $table->string('codice_fiscale');
            $table->string('codice_sdi');
            $table->string('pec');
            $table->string('indirizzo');
            $table->string('cap');
            $table->string('localita');
            $table->string('provincia');
            $table->string('paese');
            $table->string('telefono');
            $table->string('email');
            $table->string('indirizzo_dm')->nullable();
            $table->string('cap_dm')->nullable();
            $table->string('localita_dm')->nullable();
            $table->string('provincia_dm')->nullable();
            $table->string('paese_dm')->nullable();
            $table->bigInteger('id_agente_riferimento')->unsigned();
            $table->dateTime('date');
        });

        Schema::table('customers', function ($table) {
            $table->foreign('id_agente_riferimento')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
