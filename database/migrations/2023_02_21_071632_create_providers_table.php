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
        Schema::create('providers', function (Blueprint $table) {
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
            $table->dateTime('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
};
