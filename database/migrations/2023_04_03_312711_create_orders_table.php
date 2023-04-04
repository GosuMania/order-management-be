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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_customer')->unsigned();
            $table->bigInteger('id_order_type')->unsigned();
            $table->string('desc_order_type');
            $table->bigInteger('id_payment_methods')->unsigned();
            $table->string('desc_payment_methods');
            $table->bigInteger('id_season')->unsigned();
            $table->string('desc_season');
            $table->bigInteger('id_delivery')->unsigned();
            $table->string('desc_delivery');
            $table->double('total_pieces');
            $table->integer('total_amount');
            $table->dateTime('order_date');
        });
        Schema::table('orders', function ($table) {
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_customer')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_order_type')->references('id')->on('order_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_payment_methods')->references('id')->on('payment_methods')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_season')->references('id')->on('seasons')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_delivery')->references('id')->on('deliveries')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
