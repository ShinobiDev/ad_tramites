<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuponesCampaniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupones_campanias', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('fecha_canje')->nullable();
            $table->enum("estado",['sin canjear','canjeado']);
            $table->integer("id_campania");
            $table->string("transaccion_donde_se_aplico");
            $table->decimal("monto_valor_redimido",10,2);
            $table->integer('id_usuario_canje')->unsigned();
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
        Schema::dropIfExists('cupones_campanias');
    }
}
