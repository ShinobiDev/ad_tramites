<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NotificacionAnuncio;
use DB;
use App\Payu;
use App\Anuncio;
use App\Campania;
use App\User;
use App\CuponesCampania;
use Carbon\Carbon;

class CampaniasController extends Controller
{
    public function index(){

    	$users_tramitadores=User::role('Anunciante')->get();
      $users_clientes=User::role('usuario')->get();
    	//dd($users);
    	return view('campanias.index')
              ->with('users_tramitadores',$users_tramitadores)
              ->with('users_clientes',$users_clientes);
    }
    public function show(){
    	$c=Campania::where('id','>',0)->get();
    	
    	return view('campanias.show')->with('campanias',$c);
    }
    public function store(Request $request){
    	//dd($request); 
    	$data = $request->validate([
          'nombre_campania' => 'required|string|max:255',
          'numero_cupones' => 'required',
          'tipo_canje' => 'required',
          'tipo_campania' => '',
          'fecha_final_vigencia'=> '',
          'fecha_inicial_vigencia'=> '',
          'usuario'=>'',
          'limite_por_usuario'=>'',
          'valor_descuento_por'=>'',
          'valor_descuento_val'=>'',
          'costo_minimo'=>'int',
          'codigo_cupon'=>'',
          'tipo_dto'=>'',
          'es_acumulable'=>''
        ]);
        $tipo='personal';
        //dd($data);

        if($data['tipo_campania']=='compra'){

          if($data['usuario']==0){
            $tipo='global';
            
            $usuario=null;
          }else{
            $usuario=$data['usuario'];
          }  

        }else{

          if($data['usuario']==0){
            $tipo='global';
            $usuario=null;
          }else{
            $usuario=$data['usuario'];
          }

        }
        //dd($data);
        if($data['tipo_dto']=='porcentaje'){
          if($data['valor_descuento_por']==''){
            return back()
            ->with('error','Debes ingresar el porcentaje de descuento');
          }
          $valor_descuento=$data['valor_descuento_por'];
        }else{
          if($data['valor_descuento_val']==''){
            return back()
            ->with('error','Debes ingresar el valor de descuento');
          }
          $valor_descuento=$data['valor_descuento_val'];
        }


        if (false==isset($data['es_acumulable'])) {         
         $es_acumulable='0';  
        }else{
          $es_acumulable='1';  
        }
        
        
        $id_camp=Campania::insertGetId([
        				'nombre_campania'=>$data['nombre_campania'],
        				'tipo_campania'=>$tipo,
                'tipo_canje'=>$data['tipo_canje'],
                'fecha_inicial_vigencia'=>$data['fecha_inicial_vigencia'].' 00:00:00',
                'fecha_final_vigencia'=>$data['fecha_final_vigencia'].' 23:59:59',
        				'numero_de_cupones'=>$data['numero_cupones'],
                'cupones_disponibles'=>$data['numero_cupones'],
        				'id_user'=>$usuario,
                'tipo_de_descuento'=>$data['tipo_dto'],
                'es_acumulable'=>$es_acumulable,
                'limite_por_usuario'=>$data['limite_por_usuario'],
        				'valor_de_descuento'=>$valor_descuento,
                'costo_minimo'=>$data['costo_minimo'],
        				'created_at'=>Carbon::now('America/Bogota'),
        				'updated_at'=>Carbon::now('America/Bogota')
        				]);

        if($data['codigo_cupon']==""){
          $cod=strtoupper(CuponesCampania::crear_cupon(6));
        }else{
          $cod = strtoupper($data['codigo_cupon']);
          $cc=CuponesCampania::where('codigo_cupon',$cod)->get();
          if(count($cc)>0){
             return back()
            ->with('error','Este código de cupón ya esta registrado, por favor cambialo o dejalo en blanco para generar uno automáticamente');
          }
        }

        for ($i=0; $i < $data['numero_cupones']; $i++) { 

        	CuponesCampania::insert(['codigo_cupon'=>$cod,
               							'id_campania'=>$id_camp,
               							'created_at'=>Carbon::now('America/Bogota'),
               							'updated_at'=>Carbon::now('America/Bogota')
               						]);

        }
        
        if($data['numero_cupones']==1){
        	$msn="Se ha creado 1 cupon";
        }else{
        	$msn="Se han creado ".$data['numero_cupones']." cupones";
        }
        return back()
        		->with('success',$msn.', para la campaña '.$data['nombre_campania'] );


    }

    public function ver_cupones($id){
    	//dd($id);
    	$c=CuponesCampania::where([['id_campania',$id],['estado','<>','sin canjear']])->get();
    	return response()->json(['respuesta'=>true,'datos'=>$c]);
    	//$c=Campania::where('id',$id)->get();
    	//return view('campanias.tabla_campañas')->with('campanias',$c);
    	
    }

    public function eliminar_cupones($id,$id_campana){
   		CuponesCampania::where('id',$id)->delete();
   		DB::table('campanias')->where('id',$id_campana)->decrement('numero_de_cupones',1);
      DB::table('campanias')->where('id',$id_campana)->decrement('cupones_disponibles',1);
   		$cam=Campania::where('id',$id_campana)->get();
   		$reload=true;
   		if($cam[0]->numero_de_cupones==0){
   			Campania::where('id',$id_campana)->delete();
   			

   		}
   		return response()->json(['respuesta'=>true,'mensaje'=>'Cupon eliminado correctamente','reload'=>$reload]); 		
    }	
    /**
     * Funcion para canjear los cupones para recargas
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function canjear_cupones_recargas(Request $request){
      
      $resultado=CuponesCampania::redimir_cupon_recargas($request['data']['cupon'],Carbon::now('America/Bogota'),$request['data']['usuario_que_redime'],$request['data']['ref_pago'],'recarga',$request['data']['valor_pago'],$request['data']['valor_recarga'])[0]; 
      //dd($resultado);
      if($resultado['respuesta']==true){
            
            $camp=Campania::where('id',$resultado['id_campania'])->first();

            if($camp->tipo_de_descuento=='porcentaje'){
                  if($resultado['dto']==100){
                    
                      DB::table("detalle_recargas")->insert([
                                                            'id_usuario' => $request['data']['usuario_que_redime'],
                                                            'valor_recarga'=>$request['data']['valor_pago'],
                                                            "referencia_pago"=>time().$request['data']['usuario_que_redime'],
                                                             "referencia_pago_pay_u"=>time().$request['data']['usuario_que_redime'],
                                                             "metodo_pago"=>"RECARGA GRATIS",
                                                             "tipo_recarga"=>"RECARGA" ,
                                                             'estado_detalle_recarga'=>'APROBADA',
                                                             'created_at'=>Carbon::now('America/Bogota'),
                                                             'updated_at'=>Carbon::now('America/Bogota')
                                                            ]);
                      

                      User::where("id",$request['data']['usuario_que_redime'])->increment("valor_recarga",$request['data']['valor_pago']);
                      
                      $user=User::where('id',$request['data']['usuario_que_redime'])->first();

                      NotificacionAnuncio::dispatch($user, [],[$user,["valor"=>$request['data']['valor_pago'],"fecha"=>date('Y-m-d')]],"RecargaExitosa");

                       return response()->json(['respuesta'=>true,'mensaje'=>'Cupón canjeado, hemos registrado una recarga completamente gratis.','nuevo_valor'=>$request['data']['valor_pago'],'recarga_gratis'=>true,'valor_recarga'=>$user->valor_recarga,'hash_payu'=>false,'acumulable'=>$resultado['acumulable']]);
                   

                  }else{
                    $dto=$resultado['valor_dto'];

                    
                    
                    $pp = new Payu;
                    $hash=$pp->hashear($request['data']['ref_pago'],$request['data']['valor_pago']-$resultado['dto'],"COP");
                      

                    User::generar_registro_recarga_en_bd($request['data']['usuario_que_redime'],$dto,$request['data']['valor_pago'],$request['data']['ref_pago']);

                    return response()->json(['respuesta'=>true,'mensaje'=>'Cupón canjeado, ahora paga $ '.number_format($dto,0,',','.').' y recibiras $ '.number_format($request['data']['valor_recarga'],0,',','.')." en tu recarga." ,'nuevo_valor'=>$dto,'nuevo_valor_recarga'=>number_format($request['data']['valor_pago'],0,'',''),'recarga_gratis'=>false,'hash_payu'=>$hash,'acumulable'=>$resultado['acumulable']]);    
                  }
            }else{
                //pendiente implementacion para valores netos 
                    $dto=$resultado['valor_dto'];
                    //dd($dto,$camp->valor_de_descuento);
                    if($request['data']['valor_pago']==$camp->valor_de_descuento){

                      DB::table("detalle_recargas")->insert([
                                                                    'id_usuario' => $request['data']['usuario_que_redime'],
                                                                    'valor_recarga'=>$dto,
                                                                    "referencia_pago"=>time().$request['data']['usuario_que_redime'],
                                                                     "referencia_pago_pay_u"=>time().$request['data']['usuario_que_redime'],
                                                                     "metodo_pago"=>"RECARGA GRATIS",
                                                                     "tipo_recarga"=>"RECARGA" ,
                                                                     'estado_detalle_recarga'=>'APROBADA',
                                                                     'created_at'=>Carbon::now('America/Bogota'),
                                                                     'updated_at'=>Carbon::now('America/Bogota')
                                                            ]);
                      

                      User::where("id",$request['data']['usuario_que_redime'])->increment("valor_recarga",$dto);
                      
                      $user=User::where('id',$request['data']['usuario_que_redime'])->first();

                      NotificacionAnuncio::dispatch($user, [],[$user,["valor"=>$dto,"fecha"=>date('Y-m-d')]],"RecargaExitosa");

                       return response()->json(['respuesta'=>true,'mensaje'=>'Cupón canjeado, hemos registrado una recarga completamente gratis.','nuevo_valor'=>$dto,'recarga_gratis'=>true,'valor_recarga'=>$user->valor_recarga,'nuevo_valor_recarga'=>$dto,'hash_payu'=>false,'acumulable'=>$resultado['acumulable']]);


                    }else{
                      $pp = new Payu;
                      $hash=$pp->hashear($request['data']['ref_pago'],$request['data']['valor_pago']-$dto,"COP");


                        

                      User::generar_registro_recarga_en_bd($request['data']['usuario_que_redime'],$dto,$request['data']['valor_pago'],$dto,$request['data']['ref_pago']);

                      return response()->json(['respuesta'=>true,'mensaje'=>'Cupón canjeado, ahora paga $ '.number_format($request['data']['valor_pago']-$dto,0,',','.').' y recibiras $ '.number_format($request['data']['valor_recarga'],0,',','.')." en tu recarga." ,'nuevo_valor'=>$request['data']['valor_pago']-$dto,'nuevo_valor_recarga'=>$request['data']['valor_pago'],'recarga_gratis'=>false,'hash_payu'=>$hash,'acumulable'=>$resultado['acumulable']]); 
                    }

                    
                           
            }
      }else{
        return response()->json($resultado);  
      }  
      
    }
    public function canjear_cupones_compras(Request $request){
 
      $resultado=CuponesCampania::redimir_cupon_compra($request['data']['cupon'],Carbon::now('America/Bogota'),$request['data']['usuario_que_redime'],$request['data']['ref_pago'],'compra',$request['data']['valor_pago'],$request['data']['id_anuncio'],$request['data']['validar'])[0]; 
      
      if($resultado['respuesta']==true){
            
            $camp=Campania::where('id',$resultado['id_campania'])->first();

            if($camp->tipo_de_descuento=='porcentaje'){
                  if($camp->valor_de_descuento==100){
                    
                     
                      
                       $cupon="100% de descuento en el valor del trámite";
                       DB::table('registro_pagos_anuncios')
                                ->insert(['transactionId'=>$request['data']['codigo_anuncio'],
                                          'transactionState'=>4,
                                          'transation_value'=>$request['data']['valor_pago'],
                                          'id_anuncio'=>$request['data']['id_anuncio'],
                                          'id_user_compra'=>$request['data']['usuario_que_redime'],
                                          'metodo_pago'=>'BONO REGALO',
                                          'estado_pago'=>'APROBADA',
                                          'created_at'=>Carbon::now('America/Bogota'),
                                          'updated_at'=>Carbon::now('America/Bogota')
                                         ]); 
                       $comprador=User::where('id',$request['data']['usuario_que_redime'])->first();        
                       $anuncio=Anuncio::where("anuncios.id",$request['data']['id_anuncio'])
                            ->join('tramites','tramites.id','anuncios.id_tramite')
                            ->select('anuncios.ciudad','anuncios.valor_tramite','anuncios.descripcion_anuncio','tramites.nombre_tramite','anuncios.id_user')
                            ->get();
                       $anunciante=User::where('id',$anuncio[0]->id_user)->first(); 

                       NotificacionAnuncio::dispatch($comprador, [$anunciante,$anuncio[0],['url'=>config('app.url').'/admin/ver_mis_compras/'.$comprador->id.'?id='.$request['data']['codigo_anuncio']],['valor_venta'=>'$ 0.00']],[],"CompraExitosa");
                        
                        NotificacionAnuncio::dispatch($anunciante, 
                                                       [
                                                         $comprador,
                                                         $anuncio[0],
                                                         ['url'=>config('app.url').'/admin/ver_mis_ventas/'.$anunciante->id.'?id='.$request['data']['codigo_anuncio'],
                                                          
                                                         ],
                                                         ['cupon'=>$cupon]
                                                       ],
                                                        $anunciante->valor_recarga,"CompraExitosaAnunciante");
                                              
                       return response()->json(['respuesta'=>true,'mensaje'=>'Cupón canjeado, hemos registrado una compra completamente gratis.','nuevo_valor'=>$request['data']['valor_pago'],'compra_gratis'=>true,'valor_compra'=>$request['data']['valor_pago'],'hash_payu'=>false,'acumulable'=>$resultado['acumulable']]);

                  }else{

                      if($request['data']['validar']=='true'){

                       $cupon="";
                       DB::table('registro_pagos_anuncios')
                                ->insert(['transactionId'=>$request['data']['codigo_anuncio'],
                                          'transactionState'=>4,
                                          'transation_value'=>$request['data']['valor_pago'],
                                          'id_anuncio'=>$request['data']['id_anuncio'],
                                          'id_user_compra'=>$request['data']['usuario_que_redime'],
                                          'metodo_pago'=>'BONO REGALO',
                                          'estado_pago'=>'APROBADA',
                                          'created_at'=>Carbon::now('America/Bogota'),
                                          'updated_at'=>Carbon::now('America/Bogota')
                                         ]); 
                       $comprador=User::where('id',$request['data']['usuario_que_redime'])->first();        
                       $anuncio=Anuncio::where("anuncios.id",$request['data']['id_anuncio'])
                            ->join('tramites','tramites.id','anuncios.id_tramite')
                            ->select('anuncios.ciudad','anuncios.valor_tramite','anuncios.descripcion_anuncio','tramites.nombre_tramite','anuncios.id_user')
                            ->get();
                       $anunciante=User::where('id',$anuncio[0]->id_user)->first(); 

                       NotificacionAnuncio::dispatch($comprador, [$anunciante,$anuncio[0],['url'=>config('app.url').'/admin/ver_mis_compras/'.$comprador->id.'?id='.$request['data']['codigo_anuncio']],['valor_venta'=>'$ 0.00']],[],"CompraExitosa");
                        
                        NotificacionAnuncio::dispatch($anunciante, 
                                                       [
                                                         $comprador,
                                                         $anuncio[0],
                                                         ['url'=>config('app.url').'/admin/ver_mis_ventas/'.$anunciante->id.'?id='.$request['data']['codigo_anuncio'],
                                                          
                                                         ],
                                                         ['cupon'=>$cupon]
                                                       ],
                                                        $anunciante->valor_recarga,"CompraExitosaAnunciante");


                        return response()->json(['respuesta'=>true,'mensaje'=>'Cupón canjeado, hemos registrado una compra completamente gratis.','nuevo_valor'=>$request['data']['valor_pago'],'compra_gratis'=>true,'valor_compra'=>$request['data']['valor_pago'],'hash_payu'=>false,'acumulable'=>$resultado['acumulable']]);

                      }




                    $dto=$resultado['valor_dto'];

                    
                    
                    $pp = new Payu;
                    $hash=$pp->hashear($request['data']['ref_pago'],$resultado['valor_dto'],"COP");
                      

                    User::generar_registro_recarga_en_bd($request['data']['usuario_que_redime'],$dto,$request['data']['valor_pago'],$request['data']['ref_pago']);


                    return response()->json(['respuesta'=>true,'mensaje'=>'Cupón canjeado, ahora paga $ '.number_format($dto,0,',','.').' en lugar de $ '.number_format($request['data']['valor_pago'],0,',','.')." por tu trámite." ,'nuevo_valor'=>$dto,'compra_gratis'=>false,'hash_payu'=>$hash,'acumulable'=>$resultado['acumulable']]);    
                  }
            }else{
                //pendiente implementacion para valores netos 
                    $dto=$resultado['dto'];
                    //dd($dto,$camp->valor_de_descuento);
                    if($request['data']['valor_pago']==$camp->valor_de_descuento){

                     
                      $cupon="100% de descuento en el valor del trámite";
                       DB::table('registro_pagos_anuncios')
                                ->insert(['transactionId'=>$request['data']['codigo_anuncio'],
                                          'transactionState'=>4,
                                          'transation_value'=>$request['data']['valor_pago'],
                                          'id_anuncio'=>$request['data']['id_anuncio'],
                                          'id_user_compra'=>$request['data']['usuario_que_redime'],
                                          'metodo_pago'=>'BONO REGALO',
                                          'estado_pago'=>'APROBADA',
                                          'created_at'=>Carbon::now('America/Bogota'),
                                          'updated_at'=>Carbon::now('America/Bogota')
                                         ]); 
                       $comprador=User::where('id',$request['data']['usuario_que_redime'])->first();        
                       $anuncio=Anuncio::where("anuncios.id",$request['data']['id_anuncio'])
                            ->join('tramites','tramites.id','anuncios.id_tramite')
                            ->select('anuncios.ciudad','anuncios.valor_tramite','anuncios.descripcion_anuncio','tramites.nombre_tramite','anuncios.id_user')
                            ->get();
                       $anunciante=User::where('id',$anuncio[0]->id_user)->first(); 

                       NotificacionAnuncio::dispatch($comprador, [$anunciante,$anuncio[0],['url'=>config('app.url').'/admin/ver_mis_compras/'.$comprador->id.'?id='.$request['data']['codigo_anuncio']],['valor_venta'=>'$ 0.00']],[],"CompraExitosa");
                        
                        NotificacionAnuncio::dispatch($anunciante, 
                                                       [
                                                         $comprador,
                                                         $anuncio[0],
                                                         ['url'=>config('app.url').'/admin/ver_mis_ventas/'.$anunciante->id.'?id='.$request['data']['codigo_anuncio'],
                                                          
                                                         ],
                                                         ['cupon'=>$cupon]
                                                       ],
                                                        $anunciante->valor_recarga,"CompraExitosaAnunciante");


                        return response()->json(['respuesta'=>true,'mensaje'=>'Cupón canjeado, hemos registrado una compra completamente gratis.','nuevo_valor'=>$request['data']['valor_pago'],'compra_gratis'=>true,'valor_compra'=>$request['data']['valor_pago'],'hash_payu'=>false,'acumulable'=>$resultado['acumulable']]);


                    }else{


                      if($request['data']['validar']=='true'){

                       $cupon="100% de descuento en el valor del trámite";
                       DB::table('registro_pagos_anuncios')
                                ->insert(['transactionId'=>$request['data']['codigo_anuncio'],
                                          'transactionState'=>4,
                                          'transation_value'=>$request['data']['valor_pago'],
                                          'id_anuncio'=>$request['data']['id_anuncio'],
                                          'id_user_compra'=>$request['data']['usuario_que_redime'],
                                          'metodo_pago'=>'BONO REGALO',
                                          'estado_pago'=>'APROBADA',
                                          'created_at'=>Carbon::now('America/Bogota'),
                                          'updated_at'=>Carbon::now('America/Bogota')
                                         ]); 
                       $comprador=User::where('id',$request['data']['usuario_que_redime'])->first();        
                       $anuncio=Anuncio::where("anuncios.id",$request['data']['id_anuncio'])
                            ->join('tramites','tramites.id','anuncios.id_tramite')
                            ->select('anuncios.ciudad','anuncios.valor_tramite','anuncios.descripcion_anuncio','tramites.nombre_tramite','anuncios.id_user')
                            ->get();
                       $anunciante=User::where('id',$anuncio[0]->id_user)->first(); 

                       NotificacionAnuncio::dispatch($comprador, [$anunciante,$anuncio[0],['url'=>config('app.url').'/admin/ver_mis_compras/'.$comprador->id.'?id='.$request['data']['codigo_anuncio']],['valor_venta'=>'$ 0.00']],[],"CompraExitosa");
                        
                        NotificacionAnuncio::dispatch($anunciante, 
                                                       [
                                                         $comprador,
                                                         $anuncio[0],
                                                         ['url'=>config('app.url').'/admin/ver_mis_ventas/'.$anunciante->id.'?id='.$request['data']['codigo_anuncio'],
                                                          
                                                         ],
                                                         ['cupon'=>$cupon]
                                                       ],
                                                        $anunciante->valor_recarga,"CompraExitosaAnunciante");


                        return response()->json(['respuesta'=>true,'mensaje'=>'Cupón canjeado, hemos registrado una compra completamente gratis.','nuevo_valor'=>$request['data']['valor_pago'],'compra_gratis'=>true,'valor_compra'=>$request['data']['valor_pago'],'hash_payu'=>false,'acumulable'=>$resultado['acumulable']]);
                      }


                      $pp = new Payu;
                      $hash=$pp->hashear($request['data']['ref_pago'],$request['data']['valor_pago']-$resultado['dto'],"COP");
                        

                      User::generar_registro_recarga_en_bd($request['data']['usuario_que_redime'],$dto,$request['data']['valor_pago']+$dto,$request['data']['ref_pago']);
                      
                      return response()->json(['respuesta'=>true,'mensaje'=>'Cupón canjeado, ahora paga $ '.number_format($request['data']['valor_pago']-$dto,0,',','.').' en lugar de $ '.number_format($request['data']['valor_pago'],0,',','.')." por tu trámite." ,'nuevo_valor'=>$request['data']['valor_pago']-$dto,'nuevo_valor_compra'=>$request['data']['valor_pago'],'compra_gratis'=>false,'hash_payu'=>$hash,'acumulable'=>$resultado['acumulable']]); 
                    }

                    
                           
            }

        
        
        
      }else{
        return response()->json($resultado);  
      }  
      
    }
}
