@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Configuración</h4>
                <p class="card-category">Formulario para configuración</p>
            </div>
            <div class="card-body">
                <form class="row" action="parqueaderos/create"  method="POST">
                    {{ csrf_field() }}
                <label class="col-md-2 ">Nit</label><div class="col-md-10"><input type="text" id="nit" name="nit" placeholder="(sin el número de verificación)" class="col-md-10 form-control" autocomplete=off list="nits" value="{{ $parqueaderos->nit }}"><datalist id="nits">
                          </datalist></div>
                        <div><input type="hidden" id="id" name="id" value="{{ $parqueaderos->id }}" placeholder="id" class="col-md-10 form-control"></div>
                    <label class="col-md-2 ">Razón Social</label><div class="col-md-10"><input type="text" id="razon_social" name="razon_social" class="col-md-10 form-control" placeholder="ej.(Prking sas)" autocomplete=off value="{{ $parqueaderos->razon_social }}" required/></div>
                    <label class="col-md-2 ">Dirección</label><div class="col-md-4"><input type="text" id="direccion1" name="direccion1" class="col-md-10 form-control" placeholder="ej.(Calle 44 # 55 02)" autocomplete=off value="{{ $parqueaderos->direccion1 }}" required/></div>
                    <label class="col-md-2 ">Dirección (<small>opcional</small>)</label><div type="text" class="col-md-4"><input type="text" id="direccion2" name="direccion2" placeholder="" class="col-md-10 form-control" value="{{ $parqueaderos->direccion2 }}" autocomplete=off></div>
                    <label class="col-md-2 ">Propietario</label><div class="col-md-4"><input type="text" id="propietario" name="propietario" placeholder="ej.(Alejnadro Moreno)" class="col-md-10 form-control" autocomplete=off value="{{ $parqueaderos->propietario }}" required></div>
                    <label class="col-md-2 ">telefonos</label><div class="col-md-4"><input type="text" id="telefonos" name="telefonos" placeholder="ej.(3219045297)" class="col-md-10 form-control" autocomplete=off value="{{ $parqueaderos->telefonos }}" required></div>
                    <label class="col-md-2 ">Rango Factura</label><div class="col-md-4"><input type="text" id="rango_factura" name="rango_factura" placeholder="ej.(FA 0001 - FA 9999)" class="col-md-10 form-control" value="{{ $parqueaderos->rango_factura }}" autocomplete=off required></div>
                        <label class="col-md-2 ">Regimen</label><div class="col-md-4"><input type="text" value="{{ $parqueaderos->regimen }}" id="regimen" name="regimen" class="col-md-10 form-control" list="regimenes"><datalist id="regimenes">
                            <option value="SIMPLIFICADO" /><option value="COMUN"></datalist></div>
                    <label class="col-md-2 ">Porcentaje Iva (%)</label><div class="col-md-4"><input type="number" id="porcentajeIva" name="porcentajeIva" placeholder="ej.(0.19)" class="col-md-10 form-control" autocomplete=off value="{{ $parqueaderos->porcentajeIva }}" required></div>
                    <label class="col-md-2 ">Limite Vehiculos</label><div class="col-md-4"><input type="number" id="limiteVehiculos" name="limiteVehiculos" class="col-md-10 form-control" autocomplete=off value="{{ $parqueaderos->limiteVehiculos }}" required></div>
                    <label class="col-md-2 ">Limiete Motos</label><div class="col-md-4"><input type="number" id="limieteMotos" name="limieteMotos" class="col-md-10 form-control" autocomplete=off value="{{ $parqueaderos->limieteMotos }}" required></div>
                    <div class="col-md-12"><input type="submit" class="btn btn-success" value="Guardar"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Tipo Pagos</h4>
                <p class="card-category">Formulario para configuración</p>
            </div>
            <div class="card-body">
                <form class="row" action="tipoPago/create"  method="POST">
                    {{ csrf_field() }}
                    <label class="col-md-2 ">Tipo Pago</label>
                    <div class="col-md-10">
                        <input type="text" id="nombre" name="nombre" placeholder="(Nombre del pago)" class="col-md-10 form-control" autocomplete=off list="tipoPagoslist" required ><datalist id="tipoPagoslist">
                        @foreach ( $tipoPagos as $tipos )
                        <option value="{{ $tipos->nombre }}">
                        @endforeach  
                        </datalist></div>
                        <div><input type="hidden" id="id" name="id"  placeholder="id" class="col-md-10 form-control" ></div>
                    <div class="col-md-12"><input type="submit" class="btn btn-success" value="Guardar"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Tipo Vehiculo</h4>
                <p class="card-category">Formulario para configuración</p>
            </div>
            <div class="card-body">
                <form class="row" action="tipoVehiculo/create"  method="POST">
                    {{ csrf_field() }}
                    <label class="col-md-2 ">Tipo Vehiculo</label>
                    <div class="col-md-4">
                        <input type="text" id="nombre" name="nombre" placeholder="(Nombre del pago)" class="col-md-10 form-control" autocomplete=off list="tipoVehiculolist" required ><datalist id="tipoVehiculolist">
                        @foreach ( $tipoVehiculos as $tiposv )
                        <option value="{{ $tiposv->nombre }}">
                        @endforeach  
                        </datalist>
                    </div>
                    <label class="col-md-2 ">Tarifa Sugerida (<small>x hora</small>)</label><div class="col-md-4"><input type="text" id="tarifaSugerida" name="tarifaSugerida" class="col-md-10 form-control" placeholder="ej.(2000)" autocomplete=off required/></div>
                    <label class="col-md-2 ">Url Logo</label><div class="col-md-10"><input type="text" id="urlLogo" name="urlLogo" class="col-md-12 form-control" placeholder="Copia y pega la direccion de una imagen" autocomplete=off required/></div>
                    <div><input type="hidden" id="id" name="id"  placeholder="id" class="col-md-10 form-control" ></div>
                    <div class="col-md-12"><input type="submit" class="btn btn-success" value="Guardar"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Tipo Usuarios</h4>
                    <p class="card-category">Formulario para configuración</p>
                </div>
                <div class="card-body">
                    <form class="row" action="tipoUsuarios/create"  method="POST">
                        {{ csrf_field() }}
                        <label class="col-md-2 ">Tipo Usuarios</label>
                        <div class="col-md-10">
                            <input type="text" id="nombre" name="nombre" placeholder="(Nombre del tipo de usuario)" class="col-md-10 form-control" autocomplete=off list="tipoUsuariolist" required ><datalist id="tipoUsuariolist">
                            @foreach ( $tipoUsuarios as $tiposu )
                            <option value="{{ $tiposu->nombre }}">
                            @endforeach  
                            </datalist>
                        </div>
                        <div><input type="hidden" id="id" name="id"  placeholder="id" class="col-md-10 form-control" ></div>
                        <div class="col-md-12"><input type="submit" class="btn btn-success" value="Guardar"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()