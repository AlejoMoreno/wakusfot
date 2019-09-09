@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Servicios</h4>
                <p class="card-category">Formulario para actualizar servicios</p>
            </div>
            <div class="card-body">
                <form class="row" action="tarifas/create"  method="POST">
                    {{ csrf_field() }}
                    <div><input type="hidden" id="id" name="id" placeholder="id" class="col-md-10 form-control"></div>
                    <div><input type="hidden" id="idParqueadero" name="idParqueadero" class="col-md-10 form-control" value="{{ $parqueaderos->id }}"></div>
                    <label class="col-md-2 ">Tipo Vehiculo</label><div class="col-md-4"><select id="idTipoVehiculo" name="idTipoVehiculo" class="col-md-10 form-control">
                        <option value="0">Seleccione Tipo Vehiculo</option>
                        @foreach ($tiposVehiculos as $tipov)
                        <option value="{{ $tipov->id }}">{{ $tipov->nombre }}</option>
                        @endforeach
                    </select></div>
                    <label class="col-md-2 ">Nombre Tarifa</label><div class="col-md-4"><input type="text" id="nombreTarifa" name="nombreTarifa" placeholder="ej.(Moto x hora)" class="col-md-10 form-control" required list="listNombreTarifa"><datalist id="listNombreTarifa">
                        @foreach ( $tarifas as $tarif )
                        <option value="{{ $tarif->nombreTarifa }}">
                        @endforeach  
                        </datalist>
                    </div>
                    <div class="col-md-12"><br></div>
                    <label class="col-md-2 ">Valor Fracción (<small>$</small>)</label><div class="col-md-4"><input type="number" id="valorMinuto" name="valorMinuto" placeholder="ej.(500)" class="col-md-10 form-control" required></div>
                    <label class="col-md-2 ">Valor Hora (<small>$</small>)</label><div class="col-md-4"><input type="number" id="valorHora" name="valorHora" placeholder="ej.(1000)" class="col-md-10 form-control" required></div>
                    <div class="col-md-12"><br></div>
                    <label class="col-md-2 ">Valor 12 Horas (<small>$</small>)</label><div class="col-md-4"><input type="number" id="quincena" name="quincena" placeholder="ej.(300)" class="col-md-10 form-control" required></div>
                    <label class="col-md-2 ">Valor Mensualidad (<small>$</small>)</label><div class="col-md-4"><input type="number" id="mensualidad" name="mensualidad" placeholder="ej.(300)" class="col-md-10 form-control" required></div>
                    <div class="col-md-12"><br></div><label class="col-md-2 ">Vigente Desde</label><div class="col-md-4"><input type="date" id="vigendeDesde" name="vigendeDesde" placeholder="" class="col-md-10 form-control" required></div>
                    <label class="col-md-2 ">Vigente Hasta</label><div class="col-md-4"><input type="date" id="vigenteHasta" name="vigenteHasta" placeholder="" class="col-md-10 form-control" required></div>
                    <div class="col-md-12"><br></div><label class="col-md-2 ">Estado</label><div class="col-md-4"><select id="estado" name="estado" class="col-md-10 form-control" required>
                        <option value="0">Seleccione Estado</option>
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                    </select></div>
                    <div class="col-md-12"><br></div><div class="col-md-12"><input type="submit" class="btn btn-success" value="Guardar"></div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Servicios</h4>
                <p class="card-category">Esta tabla muestra las Servicios creados en el sistema</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                    <tr>
                        <th>Tipo Vehiculo</th>
                        <th>Nombre Tarifa</th>
                        <th>Valor Minuto</th>
                        <th>Valor Hora</th>
                        <th>Quincena</th>
                        <th>Mensualidad</th>
                        <th>Vigente Desde</th>
                        <th>Vigente Hasta</th>
                        <th>Estado</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($tarifas as $tarif)
                        <tr>
                            <td>{{ $tarif->idTipoVehiculo[0]->nombre }}</td>
                            <td>{{ $tarif->nombreTarifa }}</td>
                            <td>{{ $tarif->valorMinuto }}</td>
                            <td>{{ $tarif->valorHora }}</td>
                            <td>{{ $tarif->quincena }}</td>
                            <td>{{ $tarif->mensualidad }}</td>
                            <td>{{ $tarif->vigendeDesde }}</td>
                            <td>{{ $tarif->vigenteHasta }}</td>
                            <td>{{ $tarif->estado }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

@endsection()