<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anuncio;
use App\User;
use App\Tramite;
use DB;
use App\Events\CompartirCodigo;
use App\Events\NotificacionAnuncio;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   


        $u=auth()->user();
        //dd($u);
        $anuncios_consultados=array();

        if($u!=null){
            //dd($u->id);
            $uc=User::where('id','<>',auth()->user()->id)->get();
            $arr=[];
            $i=0;
            //dd($uc);
            foreach ($uc as $key => $value) {
                //dd($value->id);
                $arr[$i++]=$value->id;
            }
        }else{

            $uc=User::all();

            $arr=[];
            $i=0;
            foreach ($uc as $key => $value) {
                
                    $arr[$i++]=$value->id;
                

            }
        }


        //dd($arr);
        if(count($arr)>0){
           $anuncios_consultados= Anuncio::select('anuncios.id',
                                                   'anuncios.codigo_anuncio',
                                                   'anuncios.descripcion_anuncio',
                                                   'anuncios.estado_anuncio',
                                                   'anuncios.id_user',
                                                   'anuncios.ciudad',
                                                   'anuncios.valor_tramite',
                                                   'users.nombre',
                                                   'users.email',
                                                   'users.telefono',
                                                   'users.valor_recarga',
                                                   'users.costo_clic',
                                                   'tramites.nombre_tramite',
                                                   DB::Raw("FORMAT(users.nota/users.num_calificaciones,1) as calificacion"))
                ->join('users','users.id','anuncios.id_user')
                ->join('tramites','tramites.id','anuncios.id_tramite')
                ->where('anuncios.estado_anuncio','1')
                ->whereIn('users.id',$arr)
                ->orderBy('users.valor_recarga','DESC')
                ->get();
           //dd($anuncios_consultados);
           $ad_arr=new Anuncio();
           $arr_anuncios = $ad_arr->ver_anuncios($anuncios_consultados);
          //dd($arr_anuncios);
           return view('welcome')->with('anuncios',$arr_anuncios)->with("mis_anuncios",false)->with("tramites",Tramite::all());
        } 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
      



         
      return view('anuncios.create')->with("tramites",Tramite::all());
         
           
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->get('data'));
        $dt=$request->get('data');
        
        foreach ($dt['tramites'] as $key => $value) {
            Anuncio::insert(["codigo_anuncio"=>"t".time(),
                             "descripcion_anuncio"=>$dt["descripciones"][$key],
                             "id_user"=>auth()->user()->id,
                             "id_tramite"=>$value,
                             "valor_tramite"=>$dt["valores"][$key],
                             "ciudad"=>$dt["ubicacion"]['ciudad'],
                        ]);
            
        }
        //
        return response()->json(["respuesta"=>true,"mensaje"=>"Anuncio creado"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $ad=new Anuncio();
        $a= Anuncio::select('anuncios.id',
                            'anuncios.codigo_anuncio',
                            'anuncios.descripcion_anuncio',
                            'anuncios.estado_anuncio',
                            'anuncios.id_user',
                            'anuncios.ciudad',
                            'anuncios.valor_tramite',
                            'users.nombre',
                            'users.email',
                            'users.telefono',
                            'users.valor_recarga',
                            'users.costo_clic',
                            'users.nota',
                            'tramites.nombre_tramite',
                            DB::Raw("FORMAT(users.nota/users.num_calificaciones,1) as calificacion"))
                ->join('users','users.id','anuncios.id_user')
                ->join('tramites','tramites.id','anuncios.id_tramite')
                ->where('users.id',auth()->user()->id)
                ->get();
        //dd($a);    
        $arr_anuncios=$ad->ver_anuncios($a);
        //dd($arr_anuncios);
        return view('welcome')->with('anuncios',$arr_anuncios)->with("mis_anuncios",true)->with("tramites",Tramite::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function compartir_mail(Request $re){
        //dd($re["correos"]);
        
            CompartirCodigo::dispatch(Auth()->user(),$re["correos"]);

            return redirect()->route('users.show', auth()->user())->with('success', 'Se ha enviado tu invitación');    
    }
    /**
     * Funcion para calificar al anunciante
     * @param  Request $datos [description]
     * @return [type]         [description]
     */
    public function calificar(Request $datos){
         //dd($datos);
          $data=$datos->validate([
            'nota'=>'required',
            'id_anuncio_calificar'=>'required',
            'sel_opt_calificacion'=>'',
            'opinion'=>''

          ]);
          DB::table('detalle_clic_anuncios')
                  ->where('id',$data['id_anuncio_calificar'])
                  ->update(['calificacion'=>$data["nota"],'opinion'=>$data["sel_opt_calificacion"],'comentario'=>$data["opinion"]]);
          $dtc=DB::table('detalle_clic_anuncios')
              ->where('id',$data['id_anuncio_calificar'])
              ->get();
          $an=Anuncio::where("id",$dtc[0]->id_anuncio)->get();
          User::where("id",$an[0]->user_id)->increment("nota",$data['nota']);
          User::where("id",$an[0]->user_id)->increment("num_calificaciones",1);
           
          return redirect()->route('users.show', auth()->user())->with('success', 'Se ha registardo tu calificación ');             
    }


    /**
     * Funcion para consultar mas comentarios
     * @param  int $id_anuncio [id anuncios]
     * @param  int $min        [desde donde empieza la consulta]
     * @param  int $max        [el limite de la consulta]
     * @return [type]             [description]
     */
    public function ver_mas_comentarios($id_anuncio,$min,$max){
        $comentarios=DB::table('detalle_clic_anuncios')
                            ->where('id_anuncio',$id_anuncio)
                            ->join('users','users.id','detalle_clic_anuncios.id_usuario')
                            ->skip($min)
                            ->limit($max)
                            ->get();
        if(count($comentarios)>0){
            foreach ($comentarios as $key => $value) {
                $f=new Carbon($value->updated_at);
                $comentarios[$key]->updated_at=$f->format('M d, Y h:i A');
            }

            return response()->json(["respuesta"=>true,"datos"=>$comentarios]);    
        }else{
            return response()->json(["respuesta"=>false,"datos"=>$comentarios]);
        }                    
                                


    }   
    /**
     * Funcion para cambiar el estado de un producto
     * @param  [type] $id     [description]
     * @param  [type] $estado [description]
     * @return [type]         [description]
     */
    public function cambiar_estado_anuncio($id,$estado){
        $ad=Anuncio::where('id',$id)->get();
        //dd($ad[0]->id);
        
        //dd($re[0]->valor);
        if($estado==1){
            $est=1;
            NotificacionAnuncio::dispatch(auth()->user(), $ad[0],auth()->user()->valor_recarga,"AnuncioHabilitado");
        
        }else{
            $est='0';
            NotificacionAnuncio::dispatch(auth()->user(), $ad[0],auth()->user()->valor_recarga,"AnuncioDeshabilitado");
        
        }

        Anuncio::where("id",$id)->update(["estado_anuncio"=>$est]);
        
        
        
        return response()->json(["respuesta"=>Anuncio::where("id",$id)->select("estado_anuncio")->get()]);
    }

    public function anuncios_por_tramite(Request $request){
        $ad=new Anuncio;
        
        $arr=$request->get('data');
        //dd($arr['tipo']);
        switch ($arr['tipo']) {
            case 'anuncios':
                # code...
                $a= Anuncio::select('anuncios.id',
                            'anuncios.codigo_anuncio',
                            'anuncios.descripcion_anuncio',
                            'anuncios.estado_anuncio',
                            'anuncios.id_user',
                            'anuncios.ciudad',
                            'anuncios.valor_tramite',
                            'users.nombre',
                            'users.email',
                            'users.telefono',
                            'users.valor_recarga',
                            'users.costo_clic',
                            'users.nota',
                            'tramites.nombre_tramite',
                            DB::Raw("FORMAT(users.nota/users.num_calificaciones,1) as calificacion"))
                ->join('users','users.id','anuncios.id_user')
                ->join('tramites','tramites.id','anuncios.id_tramite')
                ->where([
                            ['users.id','<>',auth()->user()->id],
                            ['anuncios.estado_anuncio','1']

                        ])
                ->whereIn('anuncios.id_tramite',$arr['datos'])
                ->get();
                //dd($a);
                $arr_anuncios=$ad->ver_anuncios($a);
                break;
            case 'mis_anuncios':
                # code...
                $a= Anuncio::select('anuncios.id',
                            'anuncios.codigo_anuncio',
                            'anuncios.descripcion_anuncio',
                            'anuncios.estado_anuncio',
                            'anuncios.id_user',
                            'anuncios.ciudad',
                            'anuncios.valor_tramite',
                            'users.nombre',
                            'users.email',
                            'users.telefono',
                            'users.valor_recarga',
                            'users.costo_clic',
                            'users.nota',
                            'tramites.nombre_tramite',
                            DB::Raw("FORMAT(users.nota/users.num_calificaciones,1) as calificacion"))
                ->join('users','users.id','anuncios.id_user')
                ->join('tramites','tramites.id','anuncios.id_tramite')
                ->where('users.id','=',auth()->user()->id)
                ->whereIn('anuncios.id_tramite',$arr['datos'])
                ->get();
                
                $arr_anuncios=$ad->ver_anuncios($a);
                break;
            case 'anuncios_vistos_por_mi':
                # code...
                 $a= Anuncio::select('anuncios.id',
                            'anuncios.codigo_anuncio',
                            'anuncios.descripcion_anuncio',
                            'anuncios.estado_anuncio',
                            'anuncios.id_user',
                            'anuncios.ciudad',
                            'anuncios.valor_tramite',
                            'users.nombre',
                            'users.email',
                            'users.telefono',
                            'users.valor_recarga',
                            'users.costo_clic',
                            'users.nota',
                            'tramites.nombre_tramite',
                            DB::Raw("FORMAT(users.nota/users.num_calificaciones,1) as calificacion"))
                ->join('users','users.id','anuncios.id_user')
                ->join('tramites','tramites.id','anuncios.id_tramite')
                ->join('detalle_clic_anuncios','detalle_clic_anuncios.id_usuario','users.id')
                ->where([
                            ['users.id','=',auth()->user()->id],
                            ['anuncios.estado_anuncio','1']

                        ])
                ->whereIn('anuncios.id_tramite',$arr['datos'])
                ->get();
                
                $arr_anuncios=$ad->ver_anuncios($a);
                break;        
             
        }

        if(count($arr_anuncios)>0){
            return response()->json(["respuesta"=>true,"datos"=>$arr_anuncios]);            
        }
        
        return response()->json(["respuesta"=>false]);        
        
    }
}
