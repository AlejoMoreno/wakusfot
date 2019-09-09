<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tarifas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idParqueadero');
            $table->integer('idTipoVehiculo');
            $table->string('nombreTarifa');
            $table->double('valorHora');
            $table->double('valorMinuto');
            $table->double('quincena');
            $table->double('mensualidad');
            $table->string('vigendeDesde');
            $table->string('vigenteHasta');
            $table->string('estado');
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
        Schema::dropIfExists('Tarifas');
    }
}
