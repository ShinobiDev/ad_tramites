<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Campania;
use App\User;
use App\CuponesCampania;
use Carbon\Carbon;

class CampaniasController extends Controller
{
    public function index(){

    	$users=User::role('Anunciante')->get();
    	//dd($users);
    	return view('campanias.index')->with('users',$users);
    }
    public function show(){
    	$c=Campania::all();
    	
    	return view('campanias.show')->with('campanias',$c);
    }
    public function store(Request $request){
    	
    	$data = $request->validate([
          'nombre_campania' => 'required|string|max:255',
          'numero_cupones' => 'required',
          'fecha_vigencia'=> '',
          'usuario'=>'required',
          'valor_descuento'=>'required|int'
        ]);
        $tipo='personal';
        //dd($data);
        if($data['usuario']==0){
        	$tipo='global';
        	$data['usuario']=null;
        }
        $id_camp=Campania::insertGetId([
        				'nombre_campania'=>$data['nombre_campania'],
        				'tipo'=>$tipo,
        				'fecha_vigencia'=>$data['fecha_vigencia'],
        				'numero_de_cupones'=>$data['numero_cupones'],
        				'id_user'=>$data['usuario'],
        				'porcentaje_de_descuento'=>$data['valor_descuento'],
        				'created_at'=>Carbon::now('America/Bogota'),
        				'updated_at'=>Carbon::now('America/Bogota')
        				]);
        for ($i=0; $i < $data['numero_cupones']; $i++) { 
        	CuponesCampania::insert(['codigo_cupon'=>strtoupper(CuponesCampania::crear_cupon(6)),
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
   		$cam=Campania::where('id',$id_campana)->get();
   		$reload=true;
   		if($cam[0]->numero_de_cupones==0){
   			Campania::where('id',$id_campana)->delete();
   			

   		}
   		return response()->json(['respuesta'=>true,'mensaje'=>'Cupon eliminado correctamente','reload'=>$reload]); 		
    }	
}
