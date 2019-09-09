<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function(){
    return view('index');
});

Route::get('/salida', function(){
    return view('salida');
});

Route::get('/imprimir/{id}', function($id){
    $parqueaderos = App\Parqueaderos::where('id','>','0')->first();
    $pagos = App\Pagos::where('id','=',$id)->get();
    foreach($pagos as $obj){
        $obj->idEntrada = App\Entradas::where('id','=',$obj->idEntrada)->get();
        $obj->idUsuario = App\Usuarios::where('id','=',$obj->idUsuario)->get();
        $obj->idTipoPago = App\TipoPagos::where('id','=',$obj->idTipoPago)->get();
        foreach($obj->idEntrada as $obj1){
            $obj1->idCliente = App\Clientes::where('id','=',$obj1->idCliente)->get();
            $obj1->idTarifa = App\Tarifas::where('id','=',$obj1->idTarifa)->get();
        }
    }
    return view('imprimir',[
        "parqueaderos"=>$parqueaderos,
        "pagos"=>$pagos
    ]);
});
Route::get('/imprimir2/{id}', function($id){
    $parqueaderos = App\Parqueaderos::where('id','>','0')->first();
    $entradas = App\Entradas::where('id','=',$id)->get();
    return view('imprimir2',[
        "parqueaderos"=>$parqueaderos,
        "entradas"=>$entradas
    ]);
});

Route::get('/entradas', function(){
    $entradas = DB::select("SELECT * FROM entradas WHERE salidaFecha is null");
    foreach($entradas as $obj){
        $obj->idTarifa = App\Tarifas::where('id','=',$obj->idTarifa)->get();
    }
    $tarifas = App\Tarifas::all();
    $clientes = App\Clientes::all();
    $tipoPagos = App\TipoPagos::all();
    $parqueaderos = App\Parqueaderos::where('id','>','0')->first();
    return view('entradas',[
        "entradas"=>$entradas,
        "parqueaderos"=>$parqueaderos,
        "tarifas"=>$tarifas,
        "clientes"=>$clientes,
        "tipoPagos"=>$tipoPagos
    ]);
});

Route::get('/usuarios', function(){
    $usuarios = App\Usuarios::all();
    $tipoUsuarios = App\TipoUsuarios::all();
    $parqueaderos = App\Parqueaderos::where('id','>','0')->first();
    foreach($usuarios as $obj){
        $obj->idTipoUsuario = App\TipoUsuarios::where('id','=',$obj->idTipoUsuario)->get();
    }
    return view('usuario',[
        "parqueaderos"=>$parqueaderos,
        "tipoUsuarios"=>$tipoUsuarios,
        "usuarios"=>$usuarios
    ]);
});

Route::get('/servicios', function(){
    $tarifas = App\Tarifas::all();
    foreach($tarifas as $obj){
        $obj->idTipoVehiculo = App\TipoVehiculos::where('id','=',$obj->idTipoVehiculo)->get();
    }
    $tiposVehiculos = App\TipoVehiculos::all();
    $parqueaderos = App\Parqueaderos::where('id','>','0')->first();
    return view('tarifas', [
        "parqueaderos"=>$parqueaderos,
        "tarifas"=>$tarifas,
        "tiposVehiculos"=>$tiposVehiculos
    ]);
});

Route::get('/servicios/{id}', function($id){
    $tarifas = App\Tarifas::where('id','=',$id)->get();
    foreach($tarifas as $obj){
        $obj->idTipoVehiculo = App\TipoVehiculos::where('id','=',$obj->idTipoVehiculo)->get();
    }
    return array(
        "tarifas"=>$tarifas
    );
});

Route::get('/clientes', function(){
    $clientes = App\Clientes::all();
    return view('clientes',[
        "clientes"=>$clientes
    ]);
});

Route::get('/pagos', function(){
    $pagos = App\Pagos::all();
    foreach($pagos as $obj){
        $obj->idEntrada = App\Entradas::where('id','=',$obj->idEntrada)->get();
    }
    $parqueaderos = App\Parqueaderos::where('id','>','0')->first();
    return view('pagos',[
        "pagos"=>$pagos,
        "parqueaderos"=>$parqueaderos
    ]);
});

Route::get('/configuracion', function(){
    $parqueaderos = App\Parqueaderos::where('id','>','0')->first();
    $tipoPagos = App\TipoPagos::all();
    $tipoVehiculos = App\TipoVehiculos::all();
    $tipoUsuarios = App\TipoUsuarios::all();
    return view('configuracion',[
        "parqueaderos"=>$parqueaderos,
        "tipoPagos"=>$tipoPagos,
        "tipoVehiculos"=>$tipoVehiculos,
        "tipoUsuarios"=>$tipoUsuarios
    ]);
});

/**
 * PARQUEADEROS CONTROLLER
 */
Route::post('/parqueaderos/create', 'ParqueaderosController@createParqueaderos');
Route::post('/tipoPago/create', 'ParqueaderosController@createTipoPago');
Route::post('/tipoVehiculo/create', 'ParqueaderosController@tipoVehiculo');
Route::post('/tipoUsuarios/create', 'ParqueaderosController@createtipoUsuarios');
Route::post('/tarifas/create', 'ParqueaderosController@createTarifas');
Route::post('/entradas/create', 'ParqueaderosController@createEntradas');
Route::post('/pagos/createPagos', 'ParqueaderosController@createPagos');

/**
 * CONTROLLER general
 */
Route::post('/entradas/calcularTarifa', 'Controller@calcularTarifa');


/**
 * USUARIOS CONTROLLER
 */
Route::post('/clientes/create', 'UsuariosController@createClientes');
Route::post('/usuarios/create', 'UsuariosController@createUsuarios');
Route::post('/usuarios/loguin', 'UsuariosController@loguin');