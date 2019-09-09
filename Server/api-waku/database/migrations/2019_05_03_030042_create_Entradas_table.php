<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Entradas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idParqueadero');
            $table->integer('idCliente');
            $table->integer('idTarifa');
            $table->integer('idUsuario');
            $table->string('placa');
            $table->string('descripcion');
            $table->string('nota');
            $table->string('entradaFecha');
            $table->string('entradaHora');
            $table->string('reciboPrefijo');
            $table->integer('reciboNumero');
            $table->string('salidaFecha');
            $table->string('salidaHora');
            $table->string('codigoBarras');
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
        Schema::dropIfExists('Entradas');
    }
}
