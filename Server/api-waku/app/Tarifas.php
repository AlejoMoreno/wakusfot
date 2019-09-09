<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifas extends Model
{
    protected $fillable = [
        'idParqueadero',
        'idTipoVehiculo',
        'nombreTarifa',
        'valorHora',
        'valorMinuto',
        'quincena',
        'mensualidad',
        'vigendeDesde',
        'vigenteHasta',
        'estado'
    ]; 
}
