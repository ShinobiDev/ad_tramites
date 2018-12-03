<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetalleRecargas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('detalle_recargas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->enum('tipo_recarga',['BONIFICACION','RECARGA']);
            $table->decimal('valor_recarga');
            $table->string('referencia_pago');
            $table->string('referencia_pago_pay_u')->nullable();
            $table->string('metodo_pago')->nullable();
            $table->enum('estado_detalle_recarga',['APROVADA','PENDIENTE','RECHAZADA','REGISTRADA']);
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
        Schema::dropIfExists('detalle_recargas');
    }
}
