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
Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();
// E-mail verification
Route::get('/register/verify/{code}', 'UserController@verify');


//Para acceder a rutas de administrador 
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
	Route::get('/admin/videos', 'Admin\VideoController@create'); //formulario para agregar el video
	Route::post('/admin/videos', 'Admin\VideoController@store'); //Almacenamiento del video

	Route::get('/admin/tickets', 'Admin\TicketController@create'); //formulario para la creacion de boletas
	Route::post('/admin/tickets', 'Admin\TicketController@store'); //Almacenamiento de las boletas

	Route::get('/admin/documents', 'Admin\DocumentController@create'); //formulario para la carga de documentos
	Route::post('/admin/documents', 'Admin\DocumentController@store'); //Almacenamiento de los documentos

	Route::get('/admin/videos/thumbnails', 'Admin\VideoController@createThumbnail'); //formulario para la cracion de miniaturas
	Route::post('/admin/videos/thumbnails', 'Admin\VideoController@thumbnail'); //Creacion y almacenamiento de miniaturas

});

//Para acceder videos debe estar logueado y verificado
/*Route::middleware(['auth', 'verified'])->group(function () {

});*/

//Para acceder a videos premium debo tener membresia o ser administrador y estar verificado
Route::middleware(['auth', /*'verified',*/ 'premium'])->group(function () {
	Route::get('/videos/premium', 'VideoController@premium')->name('premium');
	Route::get('/videos/premium/{id}', 'VideoController@showpremium');

	Route::get('/documents/math/premium', 'DocumentController@premium'); //listado de documentos disponibles
	Route::get('/documents/math/premium/{id}', 'DocumentController@showpremium'); //mostramos documento seleccionado
});


//Para acceder a perfil, videos y documentos gratuitos solo logueado
Route::middleware(['auth'])->group(function () {
	Route::post('/users/new/verify', 'UserController@new_verify');

	Route::get('/users/profile', 'UserController@profile');
	Route::post('/users/profile', 'UserController@update');

	Route::get('/videos/free', 'VideoController@free')->name('free');
	Route::get('/videos/free/{id}', 'VideoController@showfree');

	Route::get('/users/premium', 'UserController@index');
	Route::post('/users/premium/{id}', 'UserController@premium');

	Route::get('/documents/math/free', 'DocumentController@free'); //listado de documentos disponibles
	Route::get('/documents/math/free/{id}', 'DocumentController@showfree'); //mostramos documento seleccionado
});