@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Perfil</h4>
                <p class="card-category">Formulario para actualizar usuarios</p>
            </div>
            <div class="card-body">
                <form class="row" action="usuarios/create"  method="POST">
                    {{ csrf_field() }}
                    <div><input type="hidden" id="id" name="id" placeholder="id" class="col-md-10 form-control"></div>
                    <div><input type="hidden" id="idParqueadero" name="idParqueadero" value="{{ $parqueaderos->id }}" class="col-md-10 form-control"></div>
                    <label class="col-md-2 ">Tipo Usuario</label><div class="col-md-4">
                        <select id="idTipoUsuario" name="idTipoUsuario" class="col-md-10 form-control">
                            <option value="0">Seleccione Tipo Usuario</option>
                            @foreach ($tipoUsuarios as $tipoUsuario)
                            <option value="{{ $tipoUsuario->id }}">{{ $tipoUsuario->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-md-2 ">Usuario</label><div class="col-md-4"><input type="user" id="usuario" name="usuario" placeholder="" class="col-md-10 form-control" ><datalist id="listvacia"><option value=" "></datalist></div>
                    <label class="col-md-2 ">Nombres</label><div class="col-md-4"><input type="text" id="nombres" name="nombres" placeholder="" class="col-md-10 form-control"></div>
                    <label class="col-md-2 ">Apellidos</label><div class="col-md-4"><input type="text" id="apellidos" name="apellidos" placeholder="" class="col-md-10 form-control"></div>
                    <label class="col-md-2 ">Dirección</label><div class="col-md-4"><input type="text" id="direccion" name="direccion" placeholder="ej.(calle 38 a 50 a 98)" class="col-md-10 form-control"></div>
                    <label class="col-md-2 ">Teléfono</label><div class="col-md-4"><input type="text" id="telefono" name="telefono" placeholder="ej.(3219045297)" class="col-md-10 form-control"></div>
                    <label class="col-md-2 ">Contraseña</label><div class="col-md-4"><input type="password" id="contrasena" name="contrasena" placeholder="***" class="col-md-10 form-control"></div>
                    <label class="col-md-2 ">Email</label><div class="col-md-4"><input type="email" id="email" name="email" placeholder="" class="col-md-10 form-control"></div>
                    <div class="col-md-12"><input type="submit" class="btn btn-success" value="Guardar"></div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Usuarios</h4>
                <p class="card-category">Esta tabla muestra los usuarios creados en el sistema</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Tipo Usuario</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Contraseña</th>
                        <th>Correo</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->usuario }}</td>
                            <td>{{ $usuario->nombres }}</td>
                            <td>{{ $usuario->apellidos }}</td>
                            <td>{{ $usuario->idTipoUsuario[0]->nombre }}</td>
                            <td>{{ $usuario->direccion }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->contrasena }}</td>
                            <td>{{ $usuario->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

@endsection()