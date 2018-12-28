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

Route::get('/','AnuncioController@index' )->name('anuncios.index');
Route::get('/home', 'AnuncioController@index')->name('home');
Route::post("cambio_clave","UsersController@cambio_pass")->name('cambio_credenciales');
Route::group(["prefix"=>"admin","middleware"=>"auth"],function(){
	
  Route::resource('anuncios', 'AnuncioController');	
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
  Route::get("cambiar_estado_anuncio/{id_ad}/{estado}","AnuncioController@cambiar_estado_anuncio");
  Route::get("publicar_anuncio/{id_ad}/{estado}","AnuncioController@publicar_anuncio");
  Route::post('anuncios_por_tramite','AnuncioController@anuncios_por_tramite');
  Route::resource('users', 'UsersController');
  Route::resource('roles', 'Admin\RolesController');
  Route::resource('permissions', 'Admin\PermissionsController');
  Route::middleware('role:Admin')->put('users/{user}/roles', 'Admin\UserRolesController@update')->name('users.roles.update');
  Route::middleware('role:Admin')->put('users/{user}/permissions', 'Admin\UserPermissionsController@update')->name('users.permissions.update');
  Route::get('recargas','UsersController@ver_recargas')->name('recargas.show');
  Route::get('cambiar_costo','UsersController@mostrar_cambiar_costo_clic')->name('cambiar.costo');
  Route::post('cambiar_costo','UsersController@cambiar_costo_clic')->name('cambiar.store');
  Route::post("editar_variables","UsersController@editar_variables");
  

  //Route::get("confirm_recarga","");
});

//Route::get("response_recarga","UsersController@registro_recargas");
///Route::get("response","AnuncioController@registro_venta");
Route::get('response',function(){
  $r= new App\Anuncio;
  return $r->registro_venta($_REQUEST); 
});
Route::get('confimation',function(){
  $r= new App\Anuncio;
  return $r->registro_venta($_REQUEST); 
});
/*respuesta de payu para compras de recargas*/
Route::get('response_recarga',function(){
  $r=new App\User;
  return $r->registro_recargas($_REQUEST);  
});

Route::get('confirmation_recarga',function(){
  $r=new App\User;
  return $r->registro_recargas($_REQUEST);  
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
