<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Clientes;
use App\Usuarios;

use Session;

class UsuariosController extends Controller
{
    public function createClientes(Request $request){
        $obj = Clientes::where('cedula','=',$request->cedula)->first();
        if(sizeof($obj) != 0 ){ //actualizar
            UsuariosController::ObjClientes($obj,$request);
            $obj->save();
        }
        else { //crear
            $obj = new Clientes();
            UsuariosController::ObjClientes($obj,$request);
            $obj->save();
        }
        return redirect('/clientes');
    }

    public function createUsuarios(Request $request){
        $obj = Usuarios::where('email','=',$request->email)->where('usuario','=',$request->usuario)->first();
        if(sizeof($obj) != 0 ){ //actualizar
            UsuariosController::ObjUsuarios($obj,$request);
            $obj->save();
        }
        else { //crear
            $obj = new Usuarios();
            UsuariosController::ObjUsuarios($obj,$request);
            $obj->save();
        }
        return redirect('/usuarios');
    }

    public function loguin(Request $request){
        $obj = Usuarios::where('contrasena','=',$request->contrasena)->where('usuario','=',$request->usuario)->first();
        if(sizeof($obj) != 0 ){ //si esta el usuario
            Session::put('id', $obj->id);
            Session::put('idTipoUsuario', $obj->idTipoUsuario);
            Session::put('usuario', $obj->usuario);
            Session::put('nombres', $obj->nombres." ".$obj->apellidos);
            Session::put('email', $obj->email);
            return redirect('/index');
        }
        else{ //no esta el usuario
            return redirect('/')->with('message', 'ERROR DE SESION, ALGUN DATO SE ENCUENTRA ERRADO'); ;
        }
    }

    static function ObjClientes(Clientes $obj, Request $request){
        $obj->cedula      = $request->cedula;
        $obj->titular     = $request->titular;
        $obj->Amparado    = $request->Amparado;
        $obj->direccion   = $request->direccion;
        $obj->telefono    = $request->telefono;
        $obj->estado      = $request->estado;
        return $obj;
    }

    static function ObjUsuarios(Usuarios $obj, Request $request){
        $obj->idParqueadero = $request->idParqueadero;
        $obj->idTipoUsuario = $request->idTipoUsuario;
        $obj->usuario       = $request->usuario;
        $obj->nombres       = $request->nombres;
        $obj->apellidos     = $request->apellidos;
        $obj->direccion     = $request->direccion;
        $obj->telefono      = $request->telefono;
        $obj->contrasena    = $request->contrasena;
        $obj->email         = $request->email;
        return $obj;
    }
}
