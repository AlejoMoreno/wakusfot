<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula');
            $table->string('titular');
            $table->integer('Amparado');
            $table->string('direccion');
            $table->string('telefono');
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
        Schema::dropIfExists('Clientes');
    }
}
