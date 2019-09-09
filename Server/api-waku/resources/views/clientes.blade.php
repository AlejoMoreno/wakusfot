@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Clientes</h4>
                <p class="card-category">Formulario para actualizar clientes</p>
            </div>
            <div class="card-body">
                <form class="row" action="clientes/create"  method="POST">
                    {{ csrf_field() }}
                    <div><input type="hidden" id="id" name="id" placeholder="id" class="col-md-10 form-control"></div>
                    <label class="col-md-2 ">cedula</label><div class="col-md-4"><input id="cedula" name="cedula" class="col-md-10 form-control" ></div>
                    <label class="col-md-2 ">titular</label><div class="col-md-4"><input id="titular" name="titular" class="col-md-10 form-control"></div>
                    <label class="col-md-2 ">Amparado</label><div class="col-md-4"><select id="Amparado" name="Amparado" class="col-md-10 form-control">
                        <option value="0">Seleccione si esta amparado</option>
                        <option value="1">SI</option>
                        <option value="2">NO</option>
                    </select></div>
                    <label class="col-md-2 ">direccion</label><div class="col-md-4"><input type="text" id="direccion" name="direccion" placeholder="direccion" class="col-md-10 form-control"></div>
                    <label class="col-md-2 ">telefono</label><div class="col-md-4"><input type="text" id="telefono" name="telefono" placeholder="telefono" class="col-md-10 form-control"></div>
                    <label class="col-md-2 ">estado</label><div class="col-md-4"><select id="estado" name="estado" class="col-md-10 form-control">
                        <option value="0">Seleccione estado</option>
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                    </select></div>
                    <div class="col-md-12"><input type="submit" class="btn btn-success" value="Guardar"></div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Clientes</h4>
                <p class="card-category">Esta tabla muestra los clientes creados en el sistema</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                    <tr>
                        <th>Cedula</th>
                        <th>Titular</th>
                        <th>Amparado</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Estado</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $obj)
                        <tr>
                            <td>{{ $obj->cedula }}</td>
                            <td>{{ $obj->titular }}</td>
                            <td>{{ $obj->Amparado }}</td>
                            <td>{{ $obj->direccion }}</td>
                            <td>{{ $obj->telefono }}</td>
                            <td>{{ $obj->estado }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

@endsection()