<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistroPagosAnuncios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('registro_pagos_anuncios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transactionId');
            $table->string('transactionState');
            $table->string('transation_value');
            $table->integer('id_anuncio');
            $table->integer('id_user_compra');  
            $table->string('metodo_pago');  
            $table->enum('estado_pago',['APROBADA', 'PENDIENTE', 'RECHAZADA'])->default('PENDIENTE');
            //$table->foreign('id_anuncio')->references('id')->on('anuncios');
            $table->timestamps();    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('registro_pagos_anuncios');    
    }
}
