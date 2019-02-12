<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanias', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre_campania");
            $table->enum("tipo_campania",['global','personal']);
            $table->enum("tipo_canje",['compra','recarga']);
            $table->datetime("fecha_inicial_vigencia")->nullable();
            $table->datetime("fecha_final_vigencia")->nullable();
            $table->integer("numero_de_cupones");
            $table->integer("cupones_disponibles");
            $table->integer("cupones_canjeados");
            $table->integer("id_user")->nullable();
            $table->decimal("porcentaje_de_descuento");
            $table->enum("estado_campania",['ABIERTA','CERRADA'])->default('ABIERTA');
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
        Schema::dropIfExists('campanias');
    }
}
