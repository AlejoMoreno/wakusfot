<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Sistema de autenticación API rest con Laravel

Tomado de https://medium.com/@cvallejo/sistema-de-autenticación-api-rest-con-laravel-5-6-240be1f3fc7d

### 1. Partir con una instalación fresca y nueva de laravel

Para ello, entendiendo que ya manejas algo del framework y su documentación (más info: https://laravel.com/docs/5.6) debes escribir en tu ventana de la terminal (asegúrate de estar en la carpeta donde quieres que se genere este nuevo proyecto):

`laravel new apiAuth`

Puedes escoger el nombre que quieras… en este caso utilizaremos “apiAuth” por ser muy descriptivo ;)
Recuerda que ahora debes ingresar a tu aplicación y configurar las variables de entorno (.env).

### 2. Instala el paquete de autenticación API — Passport

Este paquete es fundamental ya que, como su nombre lo indica, Laravel posee un sistema tradicional de autenticación pero, para el caso del desarrollo de una API, Laravel ofrece algo específico. Laravel Passport.

Las APIs utilizan típicamente tokens para autenticar usuarios pero no para mantener las sesiones entre los requests. Laravel ayuda a que la autenticación a través de la API sea muy simple con Laravel Passport, sistema que provee una implementación total de OAuth2 para tu aplicación de Laravel.

Seguiremos los pasos indicados en la documentación oficial (https://laravel.com/docs/5.6/passport)

### a. Comienza la instalación a través del manejador de paquetes, composer, a través del comando:

`composer require laravel/passport`

### b. Realizar la migración

`php artisan migrate`

### c. Instalación y generación de las llaves

Luego, debes ejecutar el comando passport:install. Este comando creará las llaves de encriptación necesarias para generar los tokens de acceso. Adicionalmente el comando creará el “personal access” y “password grant” de los clientes que se usarán para generar los tokens de acceso:

`php artisan passport:install`

### d. Configurar Passport

Luego de ejecutar este comando, hay que agregar el trait Laravel\Passport\HasApiTokens al modeloApp\User. Este Trait provee algunos métodos de ayuda a tu modelo que te permitirán inspeccionar al token y scope de los usuarios autenticados. (ver Laravel\Passport\HasApiTokens)

Luego tu deberás llamar al método Passport::routes dentro del método boot en tu app/Providers/AuthServiceProvider. Este método registrará las rutas necesarias para emitir tokens de acceso y revocar tokens de acceso, clientes y tokens de acceso personal ver (app/Providers/AuthServiceProvider)

Para terminar en tu archivo de configuración config/auth.php, tu deberás ajustar la opción del driver de la autenticación de la api en el ‘guards’ a passport. Esto le indicará a tu aplicación que use el TokenGuard de Passport al autenticar las solicitudes API entrantes:

### 3. Creación de las rutas de la API

A continuación lo que se requiere es la creación de las rutas necesarias para tu api. Para ello debes ingresar al servicio de rutas que Laravel provee en forma exclusiva para una apiroutes/api.php

### 4. Creación del controlador para la autenticación

Al visualizar las rutas que hemos generado más arriba podrás notar que se especifica un controlador que aún no hemos creado. Para ello deberemos crear dicho controlador a través del comando:

`php artisan make:controller AuthController`

Luego, deberemos crear cada uno de los métodos que estamos llamando:

(signup / login / logout / user)

ver (app/Http/AuthController)

Desde este punto en adelante, tu aplicación está plenamente funcional y operativa. Solo necesitas correr tu sitio en el ambiente local que tengas (homestead, valet, single server o cualquier otro entorno). En el caso de un servidor simple o directo, basta con escribir el comando:

## EJEMPLO DE API

[Para la correcta utilización, hay que configurar las siguientes dos cabeceras:]

`Content-Type: application/json
X-Requested-With: XMLHttpRequest`


# * Confirmación de cuenta y notificaciones *

tomado de https://medium.com/@cvallejo/sistema-de-autenticaci%C3%B3n-api-rest-con-laravel-5-6-572a16e3929b

## 1. Agregar columnas en tabla users

Se deben agregar tres columnas, active, activation_token y el trait softDeletes en el archivo de migración database/migrations/xxxx_create_users_table.php.

Luego es necesario agregar el trait SoftDeletes y los atributos fillable y hidden en el modelo App\User.

Una vez realizado, hay que efectuar la migración desde 0 (comando refresh). Para ello, escribir en la terminal y escribir el siguiente comando:

`php artisan migrate:refresh`

## 2. Creación de la notificación de la creación de la cuenta


En la terminar hay que escribir el siguiente comando:

`php artisan make:notification SignupActivate`

Esto creará el archivo app/Notifications/SignupActivate.php, en éste se determinarán los canales de las notificaciones que serán utilizadas (en este caso usaremos mail)

Luego crearemos las notificaciones por email. ver function toMail($notifiable)

## 2.1 Personalización del correo

Para poder personalizar el correo hay que exponer la configuración y exportar sus componentes. Para ello hay que ejecutar el siguiente comando:

`php artisan vendor:publish --tag=laravel-mail `

## 3. Crear y enviar token para confirmar la cuenta

Hay que actualizar el controlador app/Http/Controllers/AuthController.php y el método signup de la api. Para hacerlo hay que incluir el siguiente código:

Cuando se cree una nueva cuenta ésta recibirá un email con el enlace para activar su cuenta. El próximo paso es crear la ruta y el método para activar la cuenta.

## 4. Agregar la ruta para la activación de la cuenta

Hay que agregar la nueva ruta signup/activate/{token} en el archivo routes/api.php.

<?php
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');
  
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
?>

## 5. Confirmar cuenta a usuarios activos

Hay que crear el método signupActivate en el controlador app/Http/Controllers/AuthController.php para activar la cuenta del usuario.

## 6. Validación de la cuenta

Para validar que la cuenta esté activa y no ha sido borrada, hay que actualizar el método login en el controlador app/Http/Controllers/AuthController.php.

## 7. Configuración archivo “.env”

Debes asegurarte de tener configurado las variables de entorno de tu proyecto para poder enviar los emails de validación.
Para ello puedes utilizar mailgun.com, mailtrap.io o el que más te sirva para este propósito.





## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
