<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $fillable = [
        'idParqueadero',
        'idTipoUsuario',
        'usuario',
        'nombres',
        'apellidos',
        'direccion',
        'telefono',
        'contrasena',
        'email'
    ];
    
}
