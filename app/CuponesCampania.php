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
                                  ])->first();
      //dd($camp->campania->id_user,$id_usuario_canje);
      if($camp->campania->estado_campania=='ABIERTA'){
        if($camp!=null){
        //dd($camp->campania->porcentaje_de_descuento);
        if($tipo_de_campania!=$camp->campania->tipo_canje){
          return array(['respuesta'=>false,'mensaje'=>'Error de autorización: Este cupón no es válido para este tipo de transacciones. Deja el espacio vacío o verifícalo con quien te lo suministro']);
        }
        if($camp->campania->id_user!=null){

        //valido que el usuario que va registrar el cupon sea el permitido
        
            if($id_usuario_canje==$camp->campania->id_user){
              if($camp->campania->porcentaje_de_descuento==100){
                $val_dto=$monto_valor_a_redimir;
              }else{
                $val_dto=$monto_valor_a_redimir-($monto_valor_a_redimir*($camp->campania->porcentaje_de_descuento)/100);
              }
              

              CuponesCampania::registro_canje($camp->campania->id_campania,$cupon,$transaccion_canje,$id_usuario_canje,$monto_valor_a_redimir);


              return array(['respuesta'=>true,'mensaje'=>'Cupón canjeado','dto'=>$camp->campania->porcentaje_de_descuento,'valor_dto'=>$val_dto]);
            }else{
              return array(['respuesta'=>false,'mensaje'=>'Error de autorización: No estas autorizado para canjear este cupón. Deja el espacio vacío o verifícalo con quien te lo suministro']);
              
            }
          }else{
             if($camp->campania->porcentaje_de_descuento==100){
                $val_dto=$monto_valor_a_redimir;
              }else{
                $val_dto=$monto_valor_a_redimir-($monto_valor_a_redimir*($camp->campania->porcentaje_de_descuento)/100);
              }
            CuponesCampania::registro_canje($camp->campania->id_campania,$cupon,$transaccion_canje,$id_usuario_canje,$monto_valor_a_redimir);
            return array(['respuesta'=>true,'mensaje'=>'Cupón canjeado','dto'=>$camp->campania->porcentaje_de_descuento,'valor_dto'=>$val_dto]);
            
          }
        }else{

          return array(['respuesta'=>false,'mensaje'=>'Error Código cupóń: El Código del cupón no existe. Deja el espacio vacío o verifícalo con quien te lo suministro']);
        }
      }else{
        return array(['respuesta'=>false,'mensaje'=>'Error de canje: Este cupón ya no es valido. Deja el espacio vacío o verifícalo con quien te lo suministro']);
      }
      
    }

    public static function registro_canje($id_campania,$cupon,$transaccion_canje,$id_usuario_canje,$monto_valor_redimido){
      
          CuponesCampania::where([
                             ['id_campania',$id_campania] ,
                             ['codigo_cupon',$cupon],
                             ['estado','=','sin canjear'] 
                          ])
                          ->take(1)
                          ->update([
                              'estado'=>'canjeado', 
                              'fecha_canje'=>Carbon::now('America/Bogota'),
                              'transaccion_donde_se_aplico'=>$transaccion_canje,
                              'monto_valor_redimido'=>$monto_valor_redimido,
                              'id_usuario_canje'=>$id_usuario_canje,
                              'updated_at'=>Carbon::now('America/Bogota')
                            ]);
          $c=Campania::where('id',$id_campania)->first();
          if($c->cupones_disponibles < $c->cupones_canjeados){
            Campania::where('id',$id_campania)->decrement('cupones_disponibles',1);
            Campania::where('id',$id_campania)->increment('cupones_canjeados',1);
          }else{
            Campania::where(id,$id_campania)->update([
                        'estado_campania'=>'CERRADA'
                      ]);
          }
          



    }
}
