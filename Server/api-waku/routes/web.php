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


/*
|--------------------------------------------------------------------------
| Rutas api autenticación
|--------------------------------------------------------------------------
|
| A continuación lo que se requiere es la creación de las rutas necesarias 
| para tu api. Para ello debes ingresar al servicio de rutas que Laravel 
| provee en forma exclusiva para una apiroutes/api.php
|
*/
use Illuminate\Http\Request;
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
