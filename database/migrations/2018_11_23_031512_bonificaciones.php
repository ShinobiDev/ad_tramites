<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bonificaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bonificaciones', function (Blueprint $table) {

            $table->increments('id');
            $table->enum('tipo_bonificacion',['REGISTRO', 'RECARGA']);
            $table->integer('fk_id_detalle_referido');
            $table->decimal('valor_bonificacion');
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
        Schema::dropIfExists('bonificaciones');    
    }
}
