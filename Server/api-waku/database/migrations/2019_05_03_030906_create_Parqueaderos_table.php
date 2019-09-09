<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParqueaderosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Parqueaderos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razon_social');
            $table->string('direccion1');
            $table->string('direccion2');
            $table->string('propietario');
            $table->string('telefonos');
            $table->string('nit');
            $table->string('rango_factura');
            $table->string('regimen');
            $table->double('porcentajeIva');
            $table->integer('limiteVehiculos');
            $table->string('limieteMotos');
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
        Schema::dropIfExists('Parqueaderos');
    }
}
