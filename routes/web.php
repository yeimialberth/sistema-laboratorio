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
    return redirect('/login');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// home
Route::get('/home', 'HomeController@index')->name('home');

//usuarios
Route::get('/usuarios', 'UsuariosController@index')->name('usuarios');
Route::get('/formUsuarios', 'UsuariosController@formUsuarios')->name('formUsuarios');
Route::get('/formUsuariosUpdate/{id}', 'UsuariosController@formUsuariosUpdate')->name('formUsuariosUpdate');
Route::post('/saveformUsuarios','UsuariosController@saveformUsuarios')->name('saveformUsuarios');

//clientes
Route::get('/clientes', 'ClientesController@index')->name('clientes');
//Route::match(['get', 'post'], '/formClientes', 'ClientesController@formClientes')->name('formClientes');
Route::get('/formClientes', 'ClientesController@formClientes')->name('formClientes');
Route::get('/formClientesUpdate/{id}', 'ClientesController@formClientesUpdate')->name('formClientesUpdate');
Route::post('/saveformClientes','ClientesController@saveformClientes')->name('saveformClientes');
// filtros por cliente
Route::get('/filterClientes', 'ClientesController@indexFilter')->name('filterClientes');

//jeringas
Route::get('/jeringas', 'JeringasController@index')->name('jeringas');
Route::get('/formJeringas', 'JeringasController@formJeringas')->name('formJeringas');
Route::get('/formJeringasUpdate/{id}', 'JeringasController@formJeringasUpdate')->name('formJeringasUpdate');
Route::post('/saveformJeringas', 'JeringasController@saveformJeringas')->name('saveformJeringas');
Route::get('/jeringasPrestamo', 'JeringasController@jeringasPrestamo')->name('jeringasPrestamo');
// filtros por jeringa
Route::get('/filterJeringasPrestamo', 'JeringasController@filterJeringasPrestamo')->name('filterJeringasPrestamo');
Route::get('/filterJeringas', 'JeringasController@indexFilter')->name('filterJeringas');
Route::get('/listaCodigoJeringa/{idCliente}', 'JeringasController@listaCodigoJeringa')->name('listaCodigoJeringa');
// descargar listado de jeringas
Route::get('/exportarCodigoJeringa/{id}', 'JeringasController@exportarCodigoJeringa')->name('exportarCodigoJeringa');

//ingreso salida jeringas
Route::get('/controlJeringas', 'ControlJeringasController@index')->name('controlJeringas');
Route::get('/formControlJeringas/{ingsal}', 'ControlJeringasController@formControlJeringas')->name('formControlJeringas');
Route::get('/formControlJeringasUpdate/{id}', 'ControlJeringasController@formControlJeringasUpdate')->name('formControlJeringasUpdate');
Route::post('/saveformControlJeringas','ControlJeringasController@saveformControlJeringas')->name('saveformControlJeringas');
// filtros por cliente control clientes_jeringas
Route::get('/filterControlJeringas', 'ControlJeringasController@indexFilter')->name('filterControlJeringas');
// descargar control de ingresos y salidas
Route::get('/exportarControlJeringas', 'ControlJeringasController@descargarControlJeringas')->name('exportarControlJeringas');



// carga de archivos al sistema para agilizar el proceso
Route::get('/cargaDatos', 'CargaDatosController@index')->name('cargaDatos');
Route::post('/cargaIngresoJeringa', 'CargaDatosController@cargaIngresoJeringa')->name('cargaIngresoJeringa');
Route::post('/cargaSalidaJeringa', 'CargaDatosController@cargaSalidaJeringa')->name('cargaSalidaJeringa');
Route::post('/cargaJeringas', 'CargaDatosController@cargaJeringas')->name('cargaJeringas');
Route::post('/cargaClientes', 'CargaDatosController@cargaClientes')->name('cargaClientes');
Route::post('/cargaJeringasLavado', 'CargaDatosController@cargaJeringasLavado')->name('cargaJeringasLavado');

