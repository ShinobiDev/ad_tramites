<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Tramite;
use DB;

class Anuncio extends Model
{
    protected $fillable = ['codigo_anuncio','descripcion_anuncio','id_user','ciudad','estado_anuncio'];
  	

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

                        //$mostrar_payu=false;
                    
                }               

                $hs=$pu[0]->hashear($value->codigo_anuncio.'-'.time().'-'.$key,10000,"COP");

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
                                    "cod_anuncio"=>$value->codigo_anuncio,
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
}
