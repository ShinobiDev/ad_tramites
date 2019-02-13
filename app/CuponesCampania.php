<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Campania;
use Carbon\Carbon;

class CuponesCampania extends Model
{
    //
    //
   

    public static function crear_cupon($length){
          $chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
          $clen   = strlen( $chars )-1;
          $cod  = '';

          for ($i = 0; $i < $length; $i++) {
                  $cod .= $chars[mt_rand(0,$clen)];
          }
          $codigo=CuponesCampania::where('codigo_cupon',$cod)->get();
          if(count($codigo)>0){
          		CuponesCampania::crear_cupon($length);
          }
          return ($cod);
    }

    public function campania(){
        return $this->belongsTo('App\Campania','id_campania');
    }  
    public function usuario(){
        return $this->belongsTo('App\User','id_usuario_canje');
    }  

    public static function redimir_cupon($cupon,$fecha_canje,$id_usuario_canje,$transaccion_canje,$tipo_de_campania,$monto_valor_a_redimir){
      
        $camp=CuponesCampania::where([
                                    ['estado','sin canjear'],
                                    ['codigo_cupon',$cupon]
                                  ])
                              ->orwhere([
                                    ['estado','canjeado'],
                                    ['codigo_cupon',$cupon]
                                    ])
                              ->get();
        
        if(count($camp)>0){
          //dd($camp[0]->campania);
          //valido estado de la campañas
          if($camp[0]->campania->estado_campania=='ABIERTA'){
              
                  

              //********
                if($tipo_de_campania!=$camp[0]->campania->tipo_canje){
                        return array(['respuesta'=>false,'mensaje'=>'Error de autorización: Este cupón no es válido para este tipo de transacciones. Deja el espacio vacío o verifícalo con quien te lo suministro','id_campania'=>$camp[0]->campania->id]);
                }
                  
              //********
              ///*9999
               //valido si la campaña tiene usuario asignado
                  
                  if($camp[0]->campania->id_user!=null){

                    //valido que el usuario que va registrar el cupon sea el permitido
                    if($id_usuario_canje==$camp[0]->campania->id_user){

                        if($camp[0]->campania->tipo_de_descuento=='porcentaje'){
                            if($camp[0]->campania->valor_de_descuento==100){
                              $val_dto=$monto_valor_a_redimir;
                              $gratis=true;
                            }else{
                              $val_dto=$monto_valor_a_redimir-($monto_valor_a_redimir*($camp[0]->campania->valor_de_descuento)/100);
                            }  
                            $gratis=false;
                        }else{
                          // aqui hago el dto por un valor neto
                            
                            $val_dto=$camp[0]->campania->valor_de_descuento;
                            $monto_valor_a_redimir=$camp[0]->campania->valor_de_descuento;  
                            $gratis=true;
                        }
                        
                        
                        
                        $registro=CuponesCampania::registro_canje($camp[0]->campania->id,$cupon,$transaccion_canje,$id_usuario_canje,$monto_valor_a_redimir,$gratis);  
                        
                        if($registro[0]['respuesta']){
                          
                          return array(['respuesta'=>true,'mensaje'=>$registro[0]['mensaje'],'dto'=>$camp[0]->campania->valor_de_descuento,'valor_dto'=>$val_dto,'id_campania'=>$camp[0]->campania->id]);
                        }else{
                          return array(['respuesta'=>false,'mensaje'=>$registro[0]['mensaje'],'dto'=>$camp[0]->campania->valor_de_descuento,'valor_dto'=>$val_dto,'id_campania'=>$camp[0]->campania->id]);
                        }

                        
                    }else{
                         
                          return array(['respuesta'=>false,'mensaje'=>'Error de canje: no estas autorizado para cangear este cupón. Deja el espacio vacío o verifícalo con quien te lo suministro','id_campania'=>$camp[0]->campania->id]);
                         
                          
                    }
                    
                  }else{
                         //NO TIENE USUARIO ASIGNADO
                        if($camp[0]->campania->tipo_de_descuento=='porcentaje'){
                          if($camp[0]->campania->valor_de_descuento==100){
                            $val_dto=$monto_valor_a_redimir;
                            $gratis=true;
                          }else{
                            $val_dto=$monto_valor_a_redimir-($monto_valor_a_redimir*($camp[0]->campania->valor_de_descuento)/100);
                            $gratis=false;
                          }
                        }else{
                          //aqui hago el dto por un valor neto
                           $val_dto=$camp[0]->campania->valor_de_descuento;
                            $monto_valor_a_redimir=$camp[0]->campania->valor_de_descuento; 
                            $gratis=true; 
                        }  
                          $registro=CuponesCampania::registro_canje($camp[0]->campania->id,$cupon,$transaccion_canje,$id_usuario_canje,$monto_valor_a_redimir,$gratis);
                          //dd($registro[0]['respuesta']);
                          if($registro[0]['respuesta']){
                            return array(['respuesta'=>true,'mensaje'=>$registro[0]['mensaje'],'dto'=>$camp[0]->campania->valor_de_descuento,'valor_dto'=>$val_dto,'id_campania'=>$camp[0]->campania->id]);
                          }else{
                            return array(['respuesta'=>false,'mensaje'=>$registro[0]['mensaje'],'dto'=>$camp[0]->campania->valor_de_descuento,'valor_dto'=>$val_dto,'id_campania'=>$camp[0]->campania->id]);
                          } 
                  } 
                
                 
              ///*9999     



         

            }else{
                  return array(['respuesta'=>false,'mensaje'=>'Error de canje: no hay más cupones disponibles para esta campaña, esta campaña ha finalizado','id_campania'=>0]);
            }
        }else{
           return array(['respuesta'=>false,'mensaje'=>'Error de canje: este cupón no es valido. Deja el espacio vacío o verifícalo con quien te lo suministro ','id_campania'=>0]);
        }
      
      
    }

    public static function registro_canje($id_campania,$cupon,$transaccion_canje,$id_usuario_canje,$monto_valor_redimido,$free){
          
          $c=Campania::where('id',$id_campania)->first();
          $redimidos=CuponesCampania::join('campanias','campanias.id','cupones_campanias.id_campania')
                                    ->where([['campanias.id',$id_campania],['estado','canjeado_pagado'],['id_usuario_canje',$id_usuario_canje]])
                                    ->select('campanias.id')
                                    ->get();
          
          if (count($redimidos) < $c->limite_por_usuario  ){
                if($free){
                  $est='canjeado_pagado';
                }else{
                  $est='canjeado';  
                }
                
                CuponesCampania::where([
                                 ['id_campania',$id_campania] ,
                                 ['codigo_cupon',$cupon],
                                 ['estado','=','sin canjear'] 
                              ])
                              ->take(1)
                              ->update([
                                  'estado'=>$est, 
                                  'fecha_canje'=>Carbon::now('America/Bogota'),
                                  'transaccion_donde_se_aplico'=>$transaccion_canje,
                                  'monto_valor_redimido'=>$monto_valor_redimido,
                                  'id_usuario_canje'=>$id_usuario_canje,
                                  'updated_at'=>Carbon::now('America/Bogota')
                                ]);
              
              
              if($c->cupones_canjeados < $c->numero_de_cupones  ){
                Campania::where('id',$id_campania)->decrement('cupones_disponibles',1);
                Campania::where('id',$id_campania)->increment('cupones_canjeados',1);
                return array(['respuesta'=>true,'mensaje'=>'Gracias, por redimir este cupón']);
              }else{
                Campania::where("id",$id_campania)->update([
                            'estado_campania'=>'CERRADA'
                          ]);
                return array(['respuesta'=>true,'mensaje'=>'Campaña finalizada']);
              }  
          }else{
            return array(['respuesta'=>false,'mensaje'=>'Has supera el límite de tus cupones para redimir']);
            
          }
          
          



    }
}
