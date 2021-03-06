<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('telefono')->unique();
            $table->integer('codigo_referido')->nullable();
            $table->decimal('valor_recarga',10,2);
            $table->string('status_recarga');
            $table->decimal('costo_clic')->default(500);
            $table->integer('nota')->default(3);
            $table->integer('num_calificaciones')->default(1);
            $table->string('password');
            $table->date("fecha_ultima_recarga")->nullable();
            $table->string('cuenta_bancaria')->nullable();
            $table->string('certificacion_bancaria')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
