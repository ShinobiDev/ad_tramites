<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetalleHorario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('detalle_horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->enum("dia",['LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO']);
            $table->string('horario')->default('08:00|17:00');
            $table->enum('estado',['Abierto','Cerrado'])->default('Abierto');
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
        Schema::dropIfExists('detalle_horarios');
    }
}
