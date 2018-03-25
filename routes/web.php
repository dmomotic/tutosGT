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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Para acceder a rutas de administrador 
Route::middleware(['auth', 'admin'])->group(function () {
	Route::get('/admin/videos', 'Admin\VideoController@create'); //formulario para agregar el video
	Route::post('/admin/videos', 'Admin\VideoController@store'); //Almacenamiento del video

	Route::get('/admin/tickets', 'Admin\TicketController@create'); //formulario para la creacion de boletas
	Route::post('/admin/tickets', 'Admin\TicketController@store'); //Almacenamiento de las boletas

	Route::get('/admin/documents', 'Admin\DocumentController@create'); //formulario para la carga de documentos
	Route::post('/admin/documents', 'Admin\DocumentController@store'); //Almacenamiento de los documentos

});

//Para acceder a perfil y videos gratuitos solo logueado
Route::middleware(['auth'])->group(function () {
	Route::get('/users/profile', 'UserController@profile');

	Route::get('/videos/free', 'VideoController@free')->name('free');
	Route::get('/videos/free/{id}', 'VideoController@showfree');

	Route::get('/users/premium', 'UserController@index');
	Route::post('/users/premium/{id}', 'UserController@premium');

	Route::get('/documents/math/free', 'DocumentController@free'); //listado de documentos disponibles
	Route::get('/documents/math/free/{id}', 'DocumentController@showfree'); //mostramos documento seleccionado


});

//Para acceder a videos premium debo tener membresia o ser administrador
Route::middleware(['auth', 'premium'])->group(function () {
	Route::get('/videos/premium', 'VideoController@premium')->name('premium');
	Route::get('/videos/premium/{id}', 'VideoController@showpremium');

	Route::get('/documents/math/premium', 'DocumentController@premium'); //listado de documentos disponibles
	Route::get('/documents/math/premium/{id}', 'DocumentController@showpremium'); //mostramos documento seleccionado
});
