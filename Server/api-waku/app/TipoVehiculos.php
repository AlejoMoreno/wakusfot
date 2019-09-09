<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoVehiculos extends Model
{
    protected $fillable = [
        'nombre',
        'tarifaSugerida',
        'urlLogo'
    ];
}
