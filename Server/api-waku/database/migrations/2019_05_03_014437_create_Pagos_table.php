<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idParqueadero');
            $table->integer('idEntrada');
            $table->integer('idUsuario');
            $table->integer('idTipoPago');
            $table->double('subtotal');
            $table->double('valor');
            $table->double('valorDescuento');
            $table->double('iva');
            $table->double('retencion');
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
        Schema::dropIfExists('Pagos');
    }
}
