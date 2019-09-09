<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idParqueadero');
            $table->integer('idTipoUsuario');
            $table->string('usuario');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('contrasena');
            $table->string('email');
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
        Schema::dropIfExists('Usuarios');
    }
}
