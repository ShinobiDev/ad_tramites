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
Auth::routes();

Route::get('prueba',function(){

});
Route::get('register_landing/{codigo_referido}',"Auth\RegisterController@create_landing");
Route::get('/','AnuncioController@index' )->name('anuncios.index');
Route::get('/home', 'AnuncioController@index')->name('home');
Route::post("cambio_clave","UsersController@cambio_pass")->name('cambio_credenciales');
Route::get("confirmar_cambio_email/{id}/{correo}","UsersController@cambio_correo");

Route::group(["prefix"=>"admin","middleware"=>"auth"],function(){

  Route::resource('anuncios', 'AnuncioController');
	Route::get('/home', 'AnunciosController@index')->name('welcome');
	Route::get("anuncios_vistos","UsersController@anuncios_vistos_por_mi")->name('anuncios_vistos');
  Route::get('descontar_recargas/{id_anuncio}/{costo}/{id_user}/{tipo}','UsersController@registro_consulta_ad');
	Route::get("mis_bonificaciones","UsersController@mis_bonificaciones")->name('mis_bonificaciones');
  Route::get("registrar_recarga/{id_user}/{val_pagado_recarga}/{val_recarga}/{ref_pago}","UsersController@registrar_recarga");
  Route::post("compartir_mail","AnuncioController@compartir_mail");
  
  Route::get("cambiar_estado_dia/{id}/{estado}","UsersController@cambiar_estado_dia");
  Route::get("cambiar_horario/{id}/{hor}","UsersController@cambiar_horario");

  Route::post("calificar","AnuncioController@calificar");
  Route::post("calificar_venta","AnuncioController@calificar_venta");
  Route::get("ver_mas_comentarios/{id}/{min}/{max}","AnuncioController@ver_mas_comentarios"); 
  Route::get("cambiar_estado_anuncio/{id_ad}/{estado}","AnuncioController@cambiar_estado_anuncio");
  Route::get("publicar_anuncio/{id_ad}/{estado}","AnuncioController@publicar_anuncio");
  Route::resource('users', 'UsersController');
  Route::post("habilitar/{id}","UsersController@habilitar")->name('users.habilitar');
  Route::resource('roles', 'Admin\RolesController');
  Route::resource('permissions', 'Admin\PermissionsController');
  Route::middleware('role:Admin')->put('users/{user}/roles', 'Admin\UserRolesController@update')->name('users.roles.update');
  Route::middleware('role:Admin')->put('users/{user}/permissions', 'Admin\UserPermissionsController@update')->name('users.permissions.update');
  Route::get('recargas','UsersController@ver_recargas')->name('recargas.show');
  Route::get('cambiar_costo','UsersController@mostrar_cambiar_costo_clic')->name('cambiar.costo');
  Route::post('cambiar_costo','UsersController@cambiar_costo_clic')->name('cambiar.store');
  Route::get("cambiar_valor_clic/{id_user}/{costo}","UsersController@cambiar_valor_clic");
  
  Route::post("editar_variables","UsersController@editar_variables");
  Route::get("hash/{cod_ad}/{monto}/{moneda}","AnuncioController@hash");
  Route::get("ver_recargas_mis_recargas/{id}","UsersController@ver_recargas_mis_recargas");
  Route::get('ver_mis_compras/{id}',"UsersController@ver_mis_compras")->name('mis_compras');
  Route::get('ver_mis_ventas/{id}',"UsersController@ver_mis_ventas")->name('mis_ventas');
  Route::post('notificar_comprador','UsersController@notificar_comprador')->name('notificar_comprador');
  Route::post('notificar_tramitador','UsersController@notificar_tramitador')->name('notificar_tramitador');
  Route::post('notificar_tramite_finalizado','UsersController@notificar_tramite_finalizado')->name('notificar_tramite_finalizado');
  Route::post('notificar_tramite_finalizado_admin','UsersController@notificar_tramite_finalizado_admin')->name('notificar_tramite_finalizado_admin');
  Route::get('todas_las_transacciones','UsersController@todas_las_transacciones')->name('todas_las_transacciones');
  Route::post('notificar_pago_a_tramitador','UsersController@notificar_pago_a_tramitador')->name('notificar_pago_a_tramitador');
  Route::post('notificar_pago_de_tramitador','UsersController@notificar_pago_de_tramitador')->name('notificar_pago_de_tramitador');
  Route::post('actualizar_certificacion_bancaria/{id_user}','UsersController@actualizar_certificacion_bancaria');

  Route::get('campanias','CampaniasController@index')->name('campanias.index');
  Route::get('ver_campanias','CampaniasController@show')->name('campanias.show');
  Route::post('crear_campanias','CampaniasController@store')->name('campanias.store');
  Route::get('ver_cupones/{id}','CampaniasController@ver_cupones');
  Route::get('eliminar_cupon/{id}/{id_campana}',"CampaniasController@eliminar_cupones");
  Route::post('canjear_cupon_recarga',"CampaniasController@canjear_cupones_recargas");
  Route::post('canjear_cupon_compra',"CampaniasController@canjear_cupones_compras");
  Route::get('consultar_usuarios/{tipo}','UsersController@buscar_usuarios');
});

Route::post("validar_codigo","UsersController@validar_codigo");

//Route::get("response_recarga","UsersController@registro_recargas");
///Route::get("response","AnuncioController@registro_venta");
Route::get('response',function(){
  $r= new App\Anuncio;
  return $r->registro_venta($_REQUEST);
});
Route::post('payu/confirm',function(){


  $r= new App\Anuncio;
  $resp=$r->confirmar_venta($_REQUEST); 
  
});
/*respuesta de payu para compras de recargas*/
Route::get('response_recarga',function(){
  $r=new App\User;
  return $r->registro_recargas($_REQUEST);
});

Route::post('payu/confirm_recarga',function(){
  $r=new App\User;
  $resp=$r->confirmar_recargas($_REQUEST);    
});




Route::get('/clearcache', function(){
      Artisan::call('cache:clear');
      Artisan::call('config:clear');
      Artisan::call('route:clear');
      Artisan::call('view:clear');
      // Artisan::call('event:generate ');
      // Artisan::call('key:generate');
      return '<h1>se ha borrado el cache</h1>';
});
/**
 * Ruta para consultar datos que se cargaran desde el formulario principal
 */
Route::get('datos_filtro','AnuncioController@datos_filtro');

Route::get('datos_ciudades/{tramite}','AnuncioController@datos_ciudades');