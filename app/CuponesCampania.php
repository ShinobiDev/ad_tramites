<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuponesCampania extends Model
{
    //
    //
   

    public static function crear_cupon($length)
      {
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
}
