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
Route::get('/clearcache', function(){
      Artisan::call('cache:clear');
      Artisan::call('config:clear');
      Artisan::call('route:clear');
      Artisan::call('view:clear');
      // Artisan::call('event:generate ');
      // Artisan::call('key:generate');
      return '<h1>se ha borrado el cache</h1>';
  });

Route::get('/home', 'AnuncioController@index')->name('home');

Auth::routes();	
Route::get('/','AnuncioController@index' )->name('anuncios.index');
Route::group(["prefix"=>"admin","middleware"=>"auth"],function(){
	
  Route::resource('anuncios', 'AnuncioController');	
	Route::resource('users', 'UsersController');
	Route::resource('permissions', 'PermissionsController');	
	Route::resource('roles', 'RolesController');

  Route::get('/home', 'AnunciosController@index')->name('welcome');
	Route::get("anuncios_vistos","UsersController@anuncios_vistos_por_mi")->name('anuncios_vistos');
  Route::get('descontar_recargas/{id_anuncio}/{costo}/{id_user}/{tipo}','UsersController@registro_consulta_ad');
	Route::get("mis_bonificaciones","UsersController@mis_bonificaciones")->name('mis_bonificaciones');	
  Route::get("registrar_recarga/{id}/{val_recarga}/{ref_pago}","UsersController@registrar_recarga");
  Route::post("compartir_mail","AnuncioController@compartir_mail");
  Route::get('register_landing/{codigo_referido}',"Auth\RegisterController@create_landing");
  Route::get("cambiar_estado_dia/{id}/{estado}","UsersController@cambiar_estado_dia");
  Route::get("cambiar_horario/{id}/{hor}","UsersController@cambiar_horario");
  Route::get("validar_codigo/{cod}","UsersController@validar_codigo");
  Route::post("calificar","AnuncioController@calificar");
  Route::get("ver_mas_comentarios/{id}/{min}/{max}","AnuncioController@ver_mas_comentarios");
  Route::get("confirmar_cambio_email/{id}/{correo}","UsersController@cambio_correo");
  Route::post("cambio_pass","Admin\UsersController@cambio_clave");
  Route::get("cambiar_estado_anuncio/{id_ad}/{estado}","AnuncioController@cambiar_estado_anuncio");
  Route::post('anuncios_por_tramite','AnuncioController@anuncios_por_tramite');
});
