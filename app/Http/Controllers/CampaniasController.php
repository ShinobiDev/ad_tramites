<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Campania;
use App\CuponesCampania;
use Carbon\Carbon;

class CampaniasController extends Controller
{
    public function index(){
    	return view('campanias.index');
    }
    public function show(){
    	dd(Campania::all());
    	return view('campanias.show');
    }
    public function store(Request $request){
    	
    	$data = $request->validate([
          'nombre_campania' => 'required|string|max:255',
          'numero_cupones' => 'required',
          'fecha_vigencia'=> '',
          'usuario'=>'',
          'valor_descuento'=>''
        ]);
        $tipo='personal';
        //dd($data);
        if($data['usuario']==null){
        	$tipo='global';
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
        for ($i=0; $i <= $data['numero_cupones']; $i++) { 
        	CuponesCampania::insert(['codigo_cupon'=>CuponesCampania::crear_cupon(6),
               							'id_campania'=>$id_camp,
               							'created_at'=>Carbon::now('America/Bogota'),
               							'updated_at'=>Carbon::now('America/Bogota')
               						]);
        }
        
        return back()->with('success','Se han creado '.$data['numero_cupones'].', para la campaña '.$data['nombre_campania'] );

    }
}
