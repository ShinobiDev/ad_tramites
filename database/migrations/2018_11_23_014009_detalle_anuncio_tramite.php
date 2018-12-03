<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetalleAnuncioTramite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        /*Schema::create('detalle_anuncios_tramites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_anuncio");
            $table->integer('id_tramite');
            $table->decimal('valor_tramite');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        //Schema::dropIfExists('detalle_anuncios_tramites');
    }
}
