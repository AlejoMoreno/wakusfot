<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parqueaderos extends Model
{
    protected $fillable = [
        'razon_social',
        'direccion1',
        'direccion2',
        'propietario',
        'telefonos',
        'nit',
        'rango_factura',
        'regimen',
        'porcentajeIva',
        'limiteVehiculos',
        'limieteMotos'
    ];    
}
