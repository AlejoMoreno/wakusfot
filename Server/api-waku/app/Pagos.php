<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $fillable = [
        'idParqueadero',
        'idEntrada',
        'idUsuario',
        'idTipoPago',
        'subtotal',
        'valor',
        'valorDescuento',
        'iva',
        'retencion',
        'codigoBarras'
    ]; 
}
