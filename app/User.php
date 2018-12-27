<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Anuncio;
use Carbon\Carbon;
use App\Events\NotificacionAnuncio;
use DB;
class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'telefono','password','valor_recarga','costo_clic','nota','status_recarga'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function scopeAllowed($query){

        if (auth()->user()->can('view',$this)) {

            return $query;

        }

        return $query->where('id', auth()->id());

    }
    
    public function truncar_detalle(){
        DB::table('detalle_horarios')->truncate();
    }

    public function agregar_horario($id_user,$dia,$horario,$estado){

        DB::table('detalle_horarios')->insert(['id_user'=>$id_user,'dia'=>$dia,'horario'=>$horario,'estado'=>$estado]);
    }   

    /**
     * Metodo para consultar los horarios de un usuario
     * @param  [integer] $id  [id usuario]
     * @param  [string] $dia [dia de la semana ]
     * @return [type]      [description]
     */
    public function ver_horarios($id,$dia){
        $dia_n="";
        //dd($dia);
        switch ($dia) {
            case '1':
                $dia_n="LUNES";
                break;
            case '2':
                $dia_n="MARTES";
                break;
            case '3':
                $dia_n="MIERCOLES";
                break;
            case '4':
                $dia_n="JUEVES";
                break;    
            case '5':
                $dia_n="VIERNES";
                break;
            case '6':
                $dia_n="SABADO";
                break;
            case '7':
                $dia_n="DOMINGO";
                break;
        }


        $horarios=DB::table('detalle_horarios')->where([['id_user',$id],['dia',$dia_n]])->get();
        //dd($horarios);
        $hora_actual=Carbon::now('America/Bogota');
        $hora=explode("|",$horarios[0]->horario);
        if($horarios[0]->estado == "Cerrado"){
            return array("respuesta"=>false,"horarios"=>$horarios[0]);
        }        
        if( (strtotime($hora_actual->format('H:i')) >= strtotime($hora[0])) && (strtotime($hora_actual->format('H:i')) <= strtotime($hora[1])) ) {

            return array("respuesta"=>true,"horarios"=>$horarios[0]);
        } 
        return array("respuesta"=>false,"horarios"=>$horarios[0]);
        
        
    }

    public function anuncios(){
        return $this->hasMany(Anuncio::class,'id_user');
    }

    public function registro_recargas($req){
    //dd($req);
        switch ($req['transactionState']) {
            case 4:
                //APROBADA
                $rp=DB::table("detalle_recargas")->where("referencia_pago",$req['referenceCode'])->get();
                $cliente=User::where("email",$req['buyerEmail'])->get();
                //dd(count($rp));
                if(count($rp)==1){
                        

                    
                        if(count($cliente)==0){
                                $msn="Los datos de este usuario no corresponde a ninguno que este registrado en MetalBio ";

                                return view('payu.error_payu')->with("mensaje",$msn);
                        }else{
                                        $empresa=Payu::all();
                                        //dd($empresa);

                                        if($rp[0]->estado_detalle_recarga=="APROBADA"){
                                            $msn="Esta referencia de pago ya esta registrada en nuestro sistema!";
                                            return view('payu.error_payu')->with("mensaje",$msn);
                                        }else{
                                            DB::table("detalle_recargas")
                                                        ->where("referencia_pago",$req['referenceCode'])
                                                        ->update([
                                                        "referencia_pago_pay_u"=>$req['reference_pol'],
                                                        "metodo_pago"=>$req['lapPaymentMethod'],
                                                        "estado_detalle_recarga"=>"APROBADA"
                                                    ]);

                                        //dd($cliente[0]);
                                        /*
                                          incremento la recarga al usuario que hace el pago
                                         */
                                        User::where("id",$cliente[0]->id)->increment("valor_recarga",$req['TX_VALUE']);

                                        User::where("id",$cliente[0]->id)->update(["status_recarga"=>"ACTIVA",'fecha_ultima_recarga'=>Carbon::now('America/Bogota')]);
                                        
                                        /*
                                            Aqui le doy el valor de premio al referido
                                         */
                                        //buscar referido
                                        $id_ref=DetalleReferido::where("id_quien_refiere",$cliente[0]->id)->get();  
                                        /*
                                        REGISTRO LAS BONIFICACIONES
                                         */
                                        if(count($id_ref)>0){
                                            $tot_recargas=detalle_recargas::where("id_user",$cliente[0]->id)->get();

                                            if(count($tot_recargas)==0){
                                                //aunentoo el 10% de la recarga 
                                                $val_rec=(float)$req['TX_VALUE']*0.10;
                                                DB::table("detalle_recargas")->insert([
                                                        'id_user' => $id_ref[0]->id_referido,
                                                        'valor_recarga'=>$val_rec,
                                                        "referencia_pago"=>time().$cliente[0]->id,
                                                         "referencia_pago_pay_u"=>time().$cliente[0]->id,
                                                         "metodo_pago"=>"BONIFICACION RECARGA 10%  ".$cliente[0]->name,
                                                         "tipo_recarga"=>"BONIFICACION" 
                                                            ]
                                                    );
                                                    
                                                DB::table("bonificaciones")->insert(
                                                            ["tipo_bonificacion"=>"RECARGA",
                                                            "fk_id_detalle_referido"=>$id_ref[0]->id,
                                                            "valor"=>$val_rec   ]);

                                                User::where("id",$id_ref[0]->id_referido)->increment("valor_recarga",$val_rec);

                                                
                                            }else{
                                                //var_dump($id_ref[0]->id_referido);
                                                //var_dump($req['TX_VALUE']*0.01);
                                                //
                                                $val_rec=(float)$req['TX_VALUE']*0.01;  
                                                
                                                DB::table("detalle_recargas")->insert([
                                                        'id_user' => $id_ref[0]->id_referido,
                                                        'valor_recarga'=>$val_rec,
                                                        "referencia_pago"=>time().$cliente[0]->id,
                                                         "referencia_pago_pay_u"=>time().$cliente[0]->id,
                                                         "metodo_pago"=>"BONIFICACION RECARGA 1%  ".$cliente[0]->name,
                                                         "tipo_recarga"=>"BONIFICACION"
                                                            ]
                                                    );
                                                DB::table("bonificaciones")->insert(
                                                            ["tipo_bonificacion"=>"RECARGA",
                                                            "fk_id_detalle_referido"=>$id_ref[0]->id,
                                                            "valor"=>$val_rec   ]);

                                                User::where("user_id",$id_ref[0]->id_referido)->increment("valor_recarga",$val_rec);
                                            }
                                        }
                                        


                                        $recarga = User::where("id",$cliente[0]->id)->get();
                                    }
                        }

                }else{


                    if(count($rp)==0){
                        $msn="Esta referencia de pago no esta registrada en nuestro sistema!";
                        return view('payu.error_payu')->with("mensaje",$msn);
                    }else{
                        if($rp[0]->estado_detalle_recarga=="APROBADA"){
                            $msn="Ya habias registrado esta referencia de pago";
                            return view('payu.error_payu')->with("mensaje",$msn);   
                        }else{
                            $msn="Esta orden se encuentra en estado ".$rp[0]->estado_detalle_recarga ;
                            return view('payu.error_payu')->with("mensaje",$msn);
                        }
                    }
                    
                        
                }

                NotificacionAnuncio::dispatch($cliente[0], [],[$recarga[0],["valor"=>$req['TX_VALUE'],"fecha"=>date('Y-m-d')]],"RecargaExitosa");


                return view('payu.confirmar_recarga_payu')->with("respuesta",$req)
                                        ->with("empresa",$empresa)
                                        ->with("cliente",$cliente)
                                        ->with("estado","Aprobada")
                                        ->with("entidad",$req['lapPaymentMethod']);
                break;
            case 7:         
                    //pendiente de confirmacion efecty
                    $rp=DB::table("detalle_recargas")->where("referencia_pago",$req['referenceCode'])->get();
                    //dd($req['referenceCode']);
                    if(count($rp)>0){
                            $cliente=User::where("email",$req['buyerEmail'])->get();

                            if($rp[0]->estado_detalle_recarga=="PENDIENTE" || $rp[0]->estado_detalle_recarga=="PENDIENTE"){
                                $msn="Esta referencia de pago ya esta registrada en nuestro sistema con el estado ".$rp[0]->estado_detalle_recarga;

                                return view('payu.error_payu')->with("mensaje",$msn);
                            }
                        
                            if(count($cliente)==0){
                                    $msn="Los datos de este usuario no corresponde a ninguno que este registrado en MetalBio ";

                                    return view('payu.error_payu')->with("mensaje",$msn);
                            }else{
                                        $empresa=Payu::all();
                                        //dd($empresa);

                                        DB::table("detalle_recargas")
                                                ->where("referencia_pago",$req['referenceCode'])
                                                ->update([
                                        "referencia_pago_pay_u"=>$req['reference_pol'],
                                        "estado_detalle_recarga"=>"PENDIENTE",
                                        "metodo_pago"=>$req['lapPaymentMethod']
                                            ]
                                    );

                                    $recarga = User::where("id",$cliente[0]->id)->get();
                            }

                    }else{


                            $msn="Ya habias registrado esta referencia de pago, una vez realices el pago se registrara tu recarga";
                            return view('payu.error_payu')->with("mensaje",$msn);
                    }
                    //dd($recarga[0]->valor);
                    NotificacionAnuncio::dispatch($cliente[0], [],[$recarga[0],["valor"=>$req['TX_VALUE'],"fecha"=>date('Y-m-d')]],"RecargaPendiente");

                    return view('payu.confirmar_recarga_payu')->with("respuesta",$req)
                                        ->with("empresa",$empresa)
                                        ->with("cliente",$cliente)
                                        ->with("estado","Pendiente Aprobación")
                                        ->with("entidad",$req['lapPaymentMethod']);
                break;
            case 6:
                    $rp=DB::table("detalle_recargas")->where("referencia_pago",$req['referenceCode'])->get();
                    if(count($rp)==0){
                        $cliente=User::where("email",$req['buyerEmail'])->get();
                        $recarga = Recargas::where("user_id",$cliente[0]->id)->get();
                        //rechazada
                        DB::table("detalle_recargas")->update([
                                        "referencia_pago_pay_u"=>$req['reference_pol'],
                                        "estado_detalle_recarga"=>"RECHAZADA",
                                        "metodo_pago"=>$req['lapPaymentMethod']
                                            ]
                                    );
                        
                        NotificacionAnuncio::dispatch($cliente[0], [],[$recarga[0],["valor"=>$req['TX_VALUE'],"fecha"=>date('Y-m-d')]],"RecargaRechazada");

                        $msn="Tu recarga a sido rechazada, intentalo nuevamente o comunicate con tu banco o entidad de pagos para verificar, que esta sucediendo";
        
                    }else{
                        $msn="Ya habias registrado esta referencia de pago, su estado actual es: ".$rp[0]->estado_detalle_recarga;

                    }
                    
                    return view('payu.error_payu')->with("mensaje",$msn);
                    
                break;
            default:
                    $msn="No se ha registrado tu recarga ";
                    return view('payu.error_payu')->with("mensaje",$msn);
                break;
        }
    }
}
