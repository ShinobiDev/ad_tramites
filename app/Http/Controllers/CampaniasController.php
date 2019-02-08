<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NotificacionAnuncio;
use DB;
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
    	$c=Campania::all();
    	
    	return view('campanias.show')->with('campanias',$c);
    }
    public function store(Request $request){
    	
    	$data = $request->validate([
          'nombre_campania' => 'required|string|max:255',
          'numero_cupones' => 'required',
          'tipo_canje' => 'required',
          'tipo_campania' => '',
          'fecha_final_vigencia'=> '',
          'fecha_inicial_vigencia'=> '',
          'usuario_tramitador'=>'',
          'usuario_cliente'=>'',
          'valor_descuento'=>'required|int',
          'codigo_cupon'=>''
        ]);
        $tipo='personal';
        //dd($data);

        if($data['tipo_campania']=='compra'){

          if($data['usuario_cliente']==0){
            $tipo='global';
            
            $usuario=null;
          }else{
            $usuario=$data['usuario_cliente'];
          }  

        }else{

          if($data['usuario_tramitador']==0){
            $tipo='global';
            $usuario=null;
          }else{
            $usuario=$data['usuario_tramitador'];
          }

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
        				'porcentaje_de_descuento'=>$data['valor_descuento'],
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
    	$c=CuponesCampania::where('id_campania',$id)->get();
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

    public function canjear_cupones_recargas(Request $request){
      //consultar campañas validas con ese cupon 
      //
      //dd($request['data']['cupon'],$request['data']['usuario_que_redime'],Carbon::now('America/Bogota'));
      
       

      $resultado=CuponesCampania::redimir_cupon($request['data']['cupon'],Carbon::now('America/Bogota'),$request['data']['usuario_que_redime'],$request['data']['ref_pago'],'recarga',$request['data']['valor_pago'])[0]; 
      
      if($resultado['respuesta']==true){
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
                
                 return response()->json(['respuesta'=>true,'mensaje'=>'Cupón canjeado, hemos registrado una recarga completamente gratis','nuevo_valor'=>$request['data']['valor_pago'],'recarga_gratis'=>true,'valor_recarga'=>$user->valor_recarga]);
             

            }else{

              $dto=$request['data']['valor_pago']-($request['data']['valor_pago']*($resultado['dto']/100));
              User::generar_registro_recarga_en_bd($request['data']['usuario_que_redime'],$dto,$request['data']['ref_pago']);
              return response()->json(['respuesta'=>true,'mensaje'=>'Cupón canjeado, ahora paga '.number_format($dto,0,',','.').' y recibiras '.number_format($request['data']['valor_pago'],0,',','.')." en tu recarga" ,'nuevo_valor'=>$dto,'recarga_gratis'=>false]);    
            }

        
        
        
      }else{
        return response()->json($resultado);  
      }  
      
    }
}
