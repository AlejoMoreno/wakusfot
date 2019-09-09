@extends('layout')

@section('content')

<?php 

$datos = DB::select('SELECT T.idTipoVehiculo, count(*) as contador FROM entradas E, tarifas T where E.idTarifa = T.id and E.salidaFecha is null group by T.idTipoVehiculo');
foreach($datos as $obj){
        $obj->idTipoVehiculo = App\TipoVehiculos::where('id','=',$obj->idTipoVehiculo)->get();
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">Censo de vehiculos</h4>
            <p class="card-category">Esta tabla muestra los vehiculos que se encuentran en el parqueadero numero #{1}</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table">
                <thead class=" text-primary">
                <tr>
                    <th>Tipo Vehiculo</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $obj )
                    <tr>
                        <td>{{ $obj->idTipoVehiculo[0]->nombre }}</td>
                        <td>{{ $obj->contador }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>

@endsection()