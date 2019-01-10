<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\NotificacionAnuncio;
use Carbon\Carbon;
use App\Tramite;
use App\User;
use DB;

class Anuncio extends Model
{
    protected $fillable = ['codigo_anuncio','descripcion_anuncio','id_user','ciudad','estado_anuncio','validez_anuncio','id_tramite'];


  /**
    * Funcion para asociar un anuncio a un tramite
    * @param  [type] $id_anuncio [description]
    * @param  [type] $id_tramite [description]
    * @param  [type] $valor      [description]
    * @param  [type] $ciudad     [description]
    * @return [type]             [description]
    */
  /*public function asociar_tramites($id_anuncio,$id_tramite,$valor){

      DB::table('detalle_anuncios_tramites')->insert([
                                              'id_anuncio'=>$id_anuncio,
                                              "id_tramite"=>$id_tramite,
                                              "valor_tramite"=>$valor,
                                             "created_at"=>Carbon::now(),
                                              "updated_at"=>Carbon::now()]);

  } */
  /**
   * funcion que me retorna un conjuto de anuncios listos para mostra en la tabla
   * @param  [type] $anuncios_consultados [description]
   * @return [type]                       [description]
   */
  public function ver_anuncios($anuncios_consultados){



  		 $tipo="PRODUCTION";
         if(config('app.debug')){
              $tipo='TEST';
         }
  		 $pu = Payu::where("type",$tipo)->get();
  		 $v=0;
       //dd($pu);
         //genero respuesta para anuncios de ventas
         $arr_anuncios=array();

        foreach ($anuncios_consultados as $key => $value) {
                //dd($anuncios_consultados);
                /**
                 * [$mostrar_info description] variable para validar la visibilidad del boton información
                 * @var boolean
                 */
                $mostrar_info=true;
                /**
                 * [$mostrar_payu description] variable para la validar la visibilidad del boton de compra o venta
                 * @var boolean
                 */
                $mostrar_payu=true;
                /**
                 * [$mostrar_calificar description] variable para la validar la visibilidad del boton de calificacion
                 * @var boolean
                 */
                $mostrar_calificar=true;
                /**
                 * [$id_detalle_clic description] variable que contiene el id del detalle del clic para el usuario que consulta determinado anuncio
                 * @var integer
                 */
                $id_detalle_clic=0;
                /**
                 * [$visto description] Variable para incializar la fecha la viista de el cliente
                 * @var [type]
                 */
                //$visto=Carbon::now('America/Bogota')->format('M d, Y h:i A');
                $visto="";
                //dd($value->id_user);
                $u=new User();
                $horarios=$u->ver_horarios($value->id_user,date('w'));
                //dd($horarios);
                //dd([$value->costo_clic,$value->valor_recarga,$horarios["respuesta"]]);
                if(((float)$value->costo_clic > (float)$value->valor_recarga) || $horarios["respuesta"]==false || (float)$value->valor_recarga == 0  || $horarios['respuesta'] == false){


                        $mostrar_info=false;

                        $mostrar_payu=false;

                }
                $cod=$value->codigo_anuncio.'-'.$key;
                $hs=$pu[0]->hashear($cod,$value->valor_tramite,"COP");

                if(Auth()->user()!=null){


                   	  $dtc=DB::table('detalle_clic_anuncios')
                   					->where([
                         							['id_anuncio',$value->id],
                         							['id_usuario',Auth()->user()->id]
                   							])->get();


                      //valido si no existe comentario del usuario  logueado
                      if(count($dtc)>0){
                       		$f=new Carbon($dtc[0]->updated_at);
                       		$visto=$f->format('M d, Y h:i A');
                          $id_detalle_clic=$dtc[0]->id;
                        if($dtc[0]->calificacion > 0){

                            $mostrar_calificar=false;

                        }

                     	}
                }
                 //obtener los comentarios
                 $comentarios=$this->ver_comentarios($value->id,5);
                 //dd(Tramite::join('detalle_anuncios_tramites','tramites.id','detalle_anuncios_tramites.id_tramite')->where('detalle_anuncios_tramites.id_anuncio',$value->id)->get());
                $arr_anuncios[$v++]=(object)[
                                    "id"=>$value->id,
                                    "id_anunciante"=>$value->id_user,
                                    "cod_anuncio"=>$cod,
                                    "descripcion"=>$value->descripcion_anuncio,
                                    "nombre_tramite"=>$value->nombre_tramite,
                                    "valor_tramite"=>$value->valor_tramite,
                                    "costo_clic"=>$value->costo_clic,
                                    "correo_ofertante"=>$value->email,
                                    "nombre"=>$value->nombre,
                                    "telefono"=>$value->telefono,
                                    "horarios"=>$horarios["horarios"],
                                    "merchantId"=>$pu[0]->merchantId,
                                    "accountId"=>$pu[0]->accountId,
                                    "hash"=>$hs,
                                    "resp"=>$pu[0]->urlResponse,
                                    "conf"=>$pu[0]->urlConfirm,
                                    "error"=>$pu[0]->urlError,
                                    "url_api"=>$pu[0]->urlApi,
                                    "limite_clic"=>$value->valor_recarga,
                                    "btn_info"=>$mostrar_info,
                                    "btn_payu"=>$mostrar_payu,
                                    "btn_calificar"=>$mostrar_calificar,
                                    "calificacion"=>$value->calificacion,
                                    "visto"=>$visto,
                                    "id_detalle_clic"=>$id_detalle_clic,
                                    "comentarios"=>$comentarios,
                                    "estado_anuncio"=>$value->estado_anuncio,
                                    "validez_anuncio"=>$value->validez_anuncio,
                                    "ciudad"=>$value->ciudad,
                                    "estado_dia"=>$horarios["respuesta"],

                                ];


        }//fin foreach
        //dd($arr_anuncios);
        return $arr_anuncios;
  }

  /**
   * [permite consultar los comenatarios de cada anuncio]
   * @param  [type] $id     [description]
   * @param  [type] $limite [description]
   * @return [type]         [description]
   */
  public function ver_comentarios($id,$limite){

      $comentarios=DB::table('detalle_clic_anuncios')
                            ->where('id_anuncio',$id)
                            ->join('users','users.id','detalle_clic_anuncios.id_usuario')
                            ->limit($limite)
                            ->get();

     return $comentarios;
  }

  public function ver_tramites_anuncio($id){
      return DB::table('detalle_anuncios_tramites')
              ->join('tramites','detalle_anuncios_tramites.id_anuncio','tramites.id')
              ->where("detalle_tramites.id_anuncio",$id)->get();

  }

  /**
   * Funcion para registrar una venta de un anuncio
   * @param  [type] $req [description]
   * @return [type]      [description]
   */
  public function registro_venta($req){
    //dd($req);
    switch ($req['transactionState']) {
            case 4:
                //aprobada
                $comprador=User::where("email",$req['buyerEmail'])->get();

                $p=DB::table("registro_pagos_anuncios")->where("transactionId",$req['reference_pol'])->get();
                $empresa=Payu::all();
                //dd([$p,$comprador[0]->id]);
                $id_ad=explode("-",$req['referenceCode'])[1];
                if(count($p)>0){
                    if($p[0]->transactionId==$req['reference_pol']){
                      //el pago ya se habia registrado con otro estado
                      if($p[0]->estado_pago=="APROBADA"){
                        $msn="Ya habías registrado esta referencia de pago";

                        return view('payu.error_payu')->with("mensaje",$msn);

                      }else{
                        $msn="Hemos registrado tu compra";

                        DB::table("registro_pagos_anuncios")->where("id",$p[0]->id)->update(["estado_pago"=>"APROBADA"]);

                      $anuncio=Anuncio::where("anuncios.id",$id_ad)
                            ->join('tramites','tramites.id','anuncios.id_tramite')
                            ->select('anuncios.ciudad','anuncios.valor_tramite','anuncios.descripcion_anuncio','tramites.nombre_tramite','anuncios.id_user')
                            ->get();
                      
                      $anunciante=User::where("id",$anuncio[0]->id_user)->get();
                        
                        //aqui debo enviar los datos de confirmación a la cuenta de correo
                        NotificacionAnuncio::dispatch($comprador[0], [$anunciante[0],$anuncio[0],['url'=>config('app.url').'/admin/ver_mis_compras/'.$comprador[0]->id]],[],"CompraExitosa");
                        
                        NotificacionAnuncio::dispatch($anunciante[0], [$comprador[0],$anuncio[0],['url'=>config('app.url').'/admin/ver_mis_ventas/'.$anunciante[0]->id]],$anunciante[0]->valor_recarga,"CompraExitosaAnunciante");

                        return view('payu.confirmar_payu')->with("respuesta",$req)
                            ->with("empresa",$empresa)
                            ->with("cliente",$comprador)
                            ->with("estado","Aprobada")
                            ->with("entidad",$req['lapPaymentMethod']);
                      }


                    }
                }else{

                  if(count($comprador)==0){
                    $msn="Los datos de este usuario no corresponde a ninguno que este registrado en ".config('app.name');

                    return view('payu.error_payu')->with("mensaje",$msn);
                  }else{
                     $pg=DB::table("registro_pagos_anuncios")
                          ->where([
                              ["id_anuncio",$id_ad],
                              ['id_user_compra',$comprador[0]->id],
                              ["metodo_pago","PENDIENTE"]
                            ])->get();
                    if(count($pg)==0){
                          $empresa=Payu::all();
                          //dd($empresa);
                          $id_ad=explode("-",$req['referenceCode'])[1];
                          //dd([$id_ad,$comprador[0]->id]);
                          //dd($comprador[0]->id);
                          DB::table("registro_pagos_anuncios")
                              /*->where([
                                  ["id_anuncio",$id_ad],
                                  ['id_user_compra',$comprador[0]->id],
                                  ["metodo_pago","PENDIENTE"]
                                ])*/
                              ->insert([
                             'transactionId' => $req['reference_pol'],
                             'transactionState'=>$req['transactionState'],
                             'transation_value' => $req['TX_VALUE'],
                              "metodo_pago"=>$req['lapPaymentMethod'],
                              "estado_pago"=>"APROBADA",
                              "updated_at"=>Carbon::now('America/Bogota'),
                              "created_at"=>Carbon::now('America/Bogota'),
                              "id_anuncio"=>$id_ad,
                              'id_user_compra'=>$comprador[0]->id
                           ]);

                            $anuncio=Anuncio::where("id",$id_ad)->get();
                            //dd($anuncio);
                            $anunciante=User::where("id",$anuncio[0]->id_user)->get();

                                  //aqui debo enviar los datos de confirmación a la cuenta de correo
                            NotificacionAnuncio::dispatch($comprador[0], [$anunciante[0],$anuncio[0],['url'=>config('app.url').'/admin/ver_mis_compras/'.$comprador[0]->id]],[],"CompraExitosa");
                            NotificacionAnuncio::dispatch($anunciante[0], [$comprador[0],$anuncio[0],['url'=>config('app.url').'/admin/ver_mis_ventas/'.$anunciante[0]->id]],$req['TX_VALUE'],"CompraExitosaAnunciante");
                    }else{

                        $msn="Esta referencia de pago no corresponde a ningna registrada en nuestro sistema, por favor verifica con tu plataforma de pagos ";


                        return view('payu.error_payu')->with("mensaje",$msn);
                    }

                  }


                  return view('payu.confirmar_payu')->with("respuesta",$req)
                            ->with("empresa",$empresa)
                            ->with("cliente",$comprador)
                            ->with("estado","Aprobada")
                            ->with("entidad",$req['lapPaymentMethod']);
                }
              break;
            case 7:
                //dd($req);
                //pendiente de confirmacion efecty
                $comprador=User::where("email",$req['buyerEmail'])->get();
                $p=DB::table("registro_pagos_anuncios")->where("transactionId",$req['reference_pol'])->get();
                $id_ad=explode("-",$req['referenceCode'])[1];
                //dd([$p,$comprador[0],$id_ad]);
                //dd($comprador);
                if(count($p)>0){
                    if($p[0]->transactionId==$req['reference_pol']){
                      $msn="Ya habías registrado esta referencia de pago, su estado actual es: ".$p[0]->estado_pago;
                      return view('payu.error_payu')->with("mensaje",$msn);
                    }

                }else{
                  if(count($comprador)==0){
                    $msn="Los datos de este usuario no corresponde a ninguno que este registrado en MetalBit ";

                    return view('payu.error_payu')->with("mensaje",$msn);
                  }else{
                      $empresa=Payu::all();
                      //dd($empresa);
                      $id_ad=explode("-",$req['referenceCode'])[1];
                      //dd([$comprador[0]->id,$id_ad]);
                      DB::table("registro_pagos_anuncios")
                          /*->where([
                              ["id_anuncio",$id_ad],
                              ['id_user_compra',$comprador[0]->id],
                              ["metodo_pago","PENDIENTE"]
                            ])*/
                          ->insert([
                         'transactionId' => $req['reference_pol'],
                         'transactionState'=>$req['transactionState'],
                         'transation_value' => $req['TX_VALUE'],
                          "metodo_pago"=>$req['lapPaymentMethod'],
                          "estado_pago"=>"PENDIENTE",
                          "created_at"=>Carbon::now('America/Bogota'),
                          "updated_at"=>Carbon::now('America/Bogota'),
                          "id_anuncio"=>$id_ad,
                          'id_user_compra'=>$comprador[0]->id,
                              
                       ]);

                  }

                  $anuncio=Anuncio::select('anuncios.id',
                                        'anuncios.ciudad',
                                        'anuncios.valor_tramite',
                                        'anuncios.descripcion_anuncio',
                                        'tramites.nombre_tramite',
                                        'anuncios.id_user'
                                    )
                                    ->where("anuncios.id",$id_ad)
                                    ->join('tramites','anuncios.id_tramite','tramites.id')
                                    ->get();
                  $anunciante=User::where(".id",$anuncio[0]->id_user)->get();
                  //dd($anuncio[0]);
                  //aqui debo enviar los datos de confirmación a la cuenta de correo
                  NotificacionAnuncio::dispatch($comprador[0], [$anuncio[0],['url'=>config('app.url').'/admin/ver_mis_compras/'.$comprador[0]->id]],[],"CompraPendiente");

                  //dd([$anunciante[0],$comprador,$anuncio]);
                  NotificacionAnuncio::dispatch($anunciante[0],[$comprador[0],$anuncio[0],['url'=>config('app.url').'/admin/ver_mis_ventas/'.$anunciante[0]->id]],$req['TX_VALUE'],"CompraPendienteAnunciante");
                  /*return redirect()->route('confirmar_payu')
                            ->with("empresa",$empresa)
                            ->with("cliente",$comprador)
                            ->with("estado","Pendiente aprobación")
                            ->with("entidad",$req['lapPaymentMethod']);*/

                  return view('payu.confirmar_payu')
                            ->with("respuesta",$req) ->with("empresa",$empresa)
                            ->with("cliente",$comprador)
                            ->with("estado","Pendiente aprobación")
                            ->with("entidad",$req['lapPaymentMethod']);
                }
                //dd(count($cliente));
                break;
            case 6:
              //dd($req);
                $id_ad=explode("-",$req['referenceCode'])[1];
                $comprador=User::where("email",$req['buyerEmail'])->get();
                $pg=DB::table("registro_pagos_anuncios")
                          ->where([
                              ["id_anuncio",$id_ad],
                              ['id_user_compra',$comprador[0]->id],
                              ["metodo_pago","PENDIENTE"]
                            ])->get();

                if(count($pg)>0){



                    //rechazada
                    DB::table("registro_pagos_anuncios")
                       ->where([
                                ["id_anuncio",$id_ad],
                                ["id_user_compra",$comprador[0]->id]
                              ])
                       ->update([
                          'transactionId' => $req['reference_pol'],
                          'transactionState'=>$req['transactionState'],
                          'transation_value' => $req['TX_VALUE'],
                          'metodo_pago'=>$req['lapPaymentMethod'],
                          "updated_at"=>Carbon::now('America/Bogota'),
                          'estado_pago'=>"RECHAZADA" ]);
                    NotificacionAnuncio::dispatch($comprador[0], [],[],"CompraRechazada");

                    $msn="Tu pago ha sido rechazado, intentalo nuevamente o comunícate con tu banco o entidad de pagos para verificar, que esta sucediendo";
                }else{
                  $pg=DB::table("registro_pagos_anuncios")
                          ->where([
                              ["id_anuncio",$id_ad],
                              ['id_user_compra',$comprador[0]->id],
                              ["transactionId",$req['reference_pol']]
                            ])->get();
                    if(count($pg)>0){
                      $msn="Esta referencia de pago fue rechaza anteriormente, por favor intenta de nuevo para validar que se registre el pago";
                    }else{
                      $msn="Esta referencia de pago no corresponde a ninguna registrada en nuestro sistema, por favor verifica con tu plataforma de pagos ";
                    }

                }

                return view('payu.error_payu')->with("mensaje",$msn);

              break;
            default:
                $msn="No Se ha registrado exitosamente tu compra ";
                return view('payu.error_payu')->with("mensaje",$msn);
            break;
    }
  }
}
