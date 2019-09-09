<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $fillable = [
        'cedula',
        'titular',
        'Amparado',
        'direccion',
        'telefono',
        'estado'
    ];    
}
