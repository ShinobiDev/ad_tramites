<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anuncio;
use App\User;
use App\Tramite;
use App\Api;
use App\Variable;
use App\Ciudad;
use DB;
use App\Events\CompartirCodigo;
use App\Events\NotificacionAnuncio;
use Carbon\Carbon;
use App\Payu;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $no_tiene=false;
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
            if(count($_REQUEST)>0){
                //dd($_REQUEST);
                $anuncios_consultados= Anuncio::select('anuncios.id',
                                                   'anuncios.codigo_anuncio',
                                                   'anuncios.descripcion_anuncio',
                                                   'anuncios.estado_anuncio',
                                                   'anuncios.validez_anuncio',
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
                ->where([
                            ['anuncios.estado_anuncio','1'],
                            ['validez_anuncio','Activo'],
                            ['ciudad','LIKE','%'.$_REQUEST['ciudad']."%"],
                            ['tramites.nombre_tramite','LIKE','%'.$_REQUEST['tramite'].'%']
                        ])
                ->whereIn('users.id',$arr)
                ->orderBy('users.valor_recarga','DESC')
                ->get();
                //dd($anuncios_consultados);
                if(count($anuncios_consultados)==0){
                    $msn="No existen anuncios para este tramite y ciudad, te invitamos a que veas nuestros anuncios actuales";
                    $no_tiene=true;
                    $anuncios_consultados=Anuncio::select('anuncios.id',
                                                   'anuncios.codigo_anuncio',
                                                   'anuncios.descripcion_anuncio',
                                                   'anuncios.estado_anuncio',
                                                   'anuncios.validez_anuncio',
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
                    ->where([['anuncios.estado_anuncio','1'],['validez_anuncio','Activo']])
                    ->whereIn('users.id',$arr)
                    ->orderBy('users.valor_recarga','DESC')
                    ->get();
                }else{
                    $msn="Gracias por usar ".config('app.name');
                }

            }else{
                $anuncios_consultados= Anuncio::select('anuncios.id',
                                                   'anuncios.codigo_anuncio',
                                                   'anuncios.descripcion_anuncio',
                                                   'anuncios.estado_anuncio',
                                                   'anuncios.validez_anuncio',
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
                ->where([['anuncios.estado_anuncio','1'],['validez_anuncio','Activo']])
                ->whereIn('users.id',$arr)
                ->orderBy('users.valor_recarga','DESC')
                ->get();
                $msn="Gracias por usar ".config('app.name').' ';
            }

           //dd([$anuncios_consultados]);
           $ad_arr=new Anuncio();
           $arr_anuncios = $ad_arr->ver_anuncios($anuncios_consultados);
           $tramites=Tramite::select('tramites.id','tramites.nombre_tramite')
                                ->join('anuncios','tramites.id','anuncios.id_tramite')
                                ->groupby("tramites.id")
                                ->where('anuncios.estado_anuncio','1')
                                ->whereIn('anuncios.id_user',$arr)
                                ->get();
           //dd($no_tiene);
           if($no_tiene){
                 //dd($msn);
                 return view('welcome')->with('anuncios',$arr_anuncios)
                                 ->with("mis_anuncios",false)
                                 ->with("tramites",$tramites)
                                 ->with('no_tiene',$msn);
                                 //->with('success', $msn);
           }else{
                //dd($msn);
                return view('welcome')->with('anuncios',$arr_anuncios)
                                 ->with("mis_anuncios",false)
                                 ->with("tramites",$tramites);
                                 //->with('tiene', $msn);
           }


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

      return view('anuncios.create')->with("tramites",Tramite::all())
                                    ->with("key",Api::where('nombre','GoogleDirections')->select('key')->get())
                                    ->with('porcentaje',Variable::where('nombre','porcentaje_tramite')->get());
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
        $this->authorize('create',new Anuncio);

        $dt=$request->get('data');
        $can_ad=0;
        foreach ($dt['tramites'] as $key => $value) {
            Anuncio::insert(["codigo_anuncio"=>"t".time(),
                             "descripcion_anuncio"=>$dt["descripciones"][$key],
                             "id_user"=>auth()->user()->id,
                             "id_tramite"=>$value,
                             "valor_tramite"=>$dt["valores"][$key],
                             "ciudad"=>$dt["ubicacion"]['direccion'],
                             "validez_anuncio"=>'Sin publicar',

                        ]);
            $can_ad++;
        }
        //
        if($can_ad==1){
            $msn=" un nuevo anuncio, una vez sea verificado que cumpla con nuestra política, serás notificado y el anuncio será publicado";
        }else{
            $msn=$can_ad." nuevos anuncios, una vez sean verificados que cumplan con nuestra política, serás notificado y los anuncios será publicados";
        }

        NotificacionAnuncio::dispatch(auth()->user(),["Hemos registrado ".$msn],auth()->user()->valor_recarga,"AnuncioCreado");
        $uadmin=User::role('admin')->get();
        NotificacionAnuncio::dispatch($uadmin[0],["Hemos registrado ".$msn],auth()->user()->valor_recarga,"AnuncioCreadoAdmin");

        return response()->json(["respuesta"=>true,"mensaje"=>"Hemos registrado ".$msn]);

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
        if(auth()->user()->getRoleNames()[0]=="Admin"){
            $a= Anuncio::select('anuncios.id',
                            'anuncios.codigo_anuncio',
                            'anuncios.descripcion_anuncio',
                            'anuncios.estado_anuncio',
                            'anuncios.validez_anuncio',
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
                ->get();
                $tramites=Tramite::select('tramites.id','tramites.nombre_tramite')
                                ->join('anuncios','tramites.id','anuncios.id_tramite')
                                ->groupby("tramites.id")
                                ->get();

        }else{
            $a= Anuncio::select('anuncios.id',
                            'anuncios.codigo_anuncio',
                            'anuncios.descripcion_anuncio',
                            'anuncios.estado_anuncio',
                            'anuncios.validez_anuncio',
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
                $tramites=Tramite::select('tramites.id','tramites.nombre_tramite')
                                ->join('anuncios','tramites.id','anuncios.id_tramite')
                                ->groupby("tramites.id")
                                ->where('anuncios.id_user',auth()->user()->id)
                                ->get();

        }

        $arr_anuncios=$ad->ver_anuncios($a);

        return view('welcome')->with('anuncios',$arr_anuncios)->with("mis_anuncios",true)->with("tramites",$tramites);
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
         //dd($datos->get('data'));
          $data=$datos->get('data');

          DB::table('detalle_clic_anuncios')
                  ->where('id',$data['id_anuncio_calificar'])
                  ->update(['calificacion'=>$data["nota"],'opinion'=>$data["opinion"],'comentario'=>$data["opinion"],'updated_at'=>Carbon::now('America/Bogota')]);
          $dtc=DB::table('detalle_clic_anuncios')
              ->where('id',$data['id_anuncio_calificar'])
              ->get();
          $an=Anuncio::where("id",$dtc[0]->id_anuncio)->get();
          User::where("id",$an[0]->user_id)->increment("nota",$data['nota']);
          User::where("id",$an[0]->user_id)->increment("num_calificaciones",1);
           return response()->json(["respuesta"=>true,'mensaje' => 'Se ha registrado tu calificación, gracias por confiar en '.config('app.name')]);
          //return redirect()->route('users.show', auth()->user())->with('success', 'Se ha registardo tu calificación ');
    }

        /**
     * Funcion para calificar al anunciante y la venta realizada
     * @param  Request $datos [description]
     * @return [type]         [description]
     */
    public function calificar_venta(Request $datos){
         //dd($datos->get('data'));
          $data=$datos->get('data');

          DB::table('registro_pagos_anuncios')
                  ->where('id',$data['id_anuncio_calificar'])
                  ->update(['calificacion'=>$data["nota"],'opinion'=>$data["opinion"],'comentario'=>$data["opinion"],'updated_at'=>Carbon::now('America/Bogota')]);
          $dtc=DB::table('registro_pagos_anuncios')
              ->where('id',$data['id_anuncio_calificar'])
              ->get();
          $an=Anuncio::where("id",$dtc[0]->id_anuncio)->get();
          User::where("id",$an[0]->user_id)->increment("nota",$data['nota']);
          User::where("id",$an[0]->user_id)->increment("num_calificaciones",1);
        
          return response()->json(["respuesta"=>true,'mensaje' => 'Se ha registrado tu calificación, gracias por confiar en '.config('app.name')]);
          //return redirect()->route('users.show', auth()->user())->with('success', 'Se ha registardo tu calificación ');
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
        $ad=Anuncio::where('anuncios.id',$id)
                     ->join('tramites','anuncios.id_tramite','tramites.id')
                     ->select('anuncios.id',
                              'anuncios.codigo_anuncio',
                              'anuncios.descripcion_anuncio',
                              'anuncios.estado_anuncio',
                              'anuncios.validez_anuncio',
                              'anuncios.id_tramite',
                              'anuncios.id_user',
                              'anuncios.ciudad',
                              'anuncios.valor_tramite',
                              'tramites.nombre_tramite')
                      ->get();
        //dd($ad[0]->id);

        //dd($re[0]->valor);
        if(auth()->user()->hasRole("Admin")){
            

            if($estado=='1'){
                $est='Activo';
                NotificacionAnuncio::dispatch(auth()->user(), [$ad[0]],auth()->user()->valor_recarga,"AnuncioHabilitado");

            }else{
                $est='Bloqueado';
                NotificacionAnuncio::dispatch(auth()->user(), [$ad[0]],auth()->user()->valor_recarga,"AnuncioBloqueado");

            }
            //dd($est);
            Anuncio::where("id",$id)->update(["validez_anuncio"=>$est]);
            return response()->json(["respuesta"=>Anuncio::where("id",$id)->select("validez_anuncio")->get()]);
        }else{
            if($estado=="1"){
                $est='1';
                NotificacionAnuncio::dispatch(auth()->user(), [$ad[0]],auth()->user()->valor_recarga,"AnuncioHabilitado");

            }else{
                $est='0';
                NotificacionAnuncio::dispatch(auth()->user(), [$ad[0]],auth()->user()->valor_recarga,"AnuncioDeshabilitado");

            }
        }

        

        Anuncio::where("id",$id)->update(["estado_anuncio"=>$est]);



        return response()->json(["respuesta"=>Anuncio::where("id",$id)->select("estado_anuncio")->get()]);
    }
    /**
     * Funcion para cambiar el estado y lo deja publicado
     * @param  [type] $id     [description]
     * @param  [type] $estado [description]
     * @return [type]         [description]
     */
    public function publicar_anuncio($id,$estado){
        $ad=Anuncio::where('anuncios.id',$id)
                     ->join('tramites','anuncios.id_tramite','tramites.id')
                     ->select('anuncios.id',
                              'anuncios.codigo_anuncio',
                              'anuncios.descripcion_anuncio',
                              'anuncios.estado_anuncio',
                              'anuncios.validez_anuncio',
                              'anuncios.id_tramite',
                              'anuncios.id_user',
                              'anuncios.ciudad',
                              'anuncios.valor_tramite',
                              'tramites.nombre_tramite')
                      ->get();
        $us_ad=User::where('id',$ad[0]->id_user)->get();
        if(auth()->user()->hasRole("Admin")){
            //dd($estado);

            if($estado=='1'){
                $est='Activo';
                NotificacionAnuncio::dispatch($us_ad[0], [$ad[0]],auth()->user()->valor_recarga,"AnuncioPublicado");

            }else{
                $est='Sin publicar';
                NotificacionAnuncio::dispatch($us_ad[0], [$ad[0]],auth()->user()->valor_recarga,"AnuncioDeshabilitado");

            }
            //dd($est);
            Anuncio::where("id",$id)->update(["validez_anuncio"=>$est]);
            return response()->json(["respuesta"=>Anuncio::where("id",$id)->select("validez_anuncio")->get()]);
        }
        if($estado=="1"){
            $est='1';
            //NotificacionAnuncio::dispatch($us_ad[0], [$ad[0]],auth()->user()->valor_recarga,"AnuncioHabilitado");

        }else{
            $est='0';
            //NotificacionAnuncio::dispatch($us_ad[0], [$ad[0]],auth()->user()->valor_recarga,"AnuncioDeshabilitado");

        }

        Anuncio::where("id",$id)->update(["estado_anuncio"=>$est]);



        return response()->json(["respuesta"=>Anuncio::where("id",$id)->select("validez_anuncio")->get()]);
    }


    public function registro_venta(){
        $ad= new Anuncio;
        $ad->registro_venta($_REQUEST);
    }


    public function datos_filtro(){
        return response()->json(["tramites"=>Tramite::all(),"ciudades"=>Anuncio::select('ciudad')->groupby('ciudad')->get()]);
        //return response()->json(["tramites"=>Tramite::all(),"ciudades"=>Ciudad::all()]);

    }
    /**
     * Funcion para crear hash del pago en payu para recargas
     * @param  [type] $a [codigo anuncio]
     * @param  [type] $p [valor de la venta]
     * @param  [type] $m [modena para hacer el pago]
     * @return [type]    [description]
     */
    public function hash($a,$p,$m){

         $pu = Payu::all();
         return response()->json(["valor"=>$pu[0]->hashear($a,$p,$m)]);
    }

}
