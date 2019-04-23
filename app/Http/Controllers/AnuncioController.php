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
                if($_REQUEST['ciudad']!= "" && $_REQUEST['tramite']!= ""){
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
                              ['tramites.nombre_tramite','LIKE',$_REQUEST['tramite']]
                          ])
                  ->whereIn('users.id',$arr)
                  ->orderBy('users.valor_recarga','DESC')
                  ->orderBy('anuncios.id','DESC')
                  ->get();       
                }elseif($_REQUEST['ciudad']!= "" && $_REQUEST['tramite'] == ""){
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
                              
                          ])
                  ->whereIn('users.id',$arr)
                  ->orderBy('users.valor_recarga','DESC')
                  ->orderBy('anuncios.id','DESC')
                  ->get();
                }elseif($_REQUEST['ciudad']== "" && $_REQUEST['tramite']!= ""){
                  
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
                              ['anuncios.estado_anuncio','=','1'],
                              ['validez_anuncio','Activo'],
                              ['tramites.nombre_tramite','LIKE',$_REQUEST['tramite']]
                          ])
                  ->whereIn('users.id',$arr)
                  ->orderBy('users.valor_recarga','DESC')
                  ->orderBy('anuncios.id','DESC')
                  ->get();
                }elseif($_REQUEST['ciudad']== "" && $_REQUEST['tramite']== ""){
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
                              ['validez_anuncio','Activo']
                              
                              
                          ])
                  ->whereIn('users.id',$arr)
                  ->orderBy('users.valor_recarga','DESC')
                  ->orderBy('anuncios.id','DESC')
                  ->get();
                }



                
                
                //dd($anuncios_consultados);
                if(count($anuncios_consultados)==0){
                    $msn="Error en Búsqueda. Filtra en la casilla Buscar.";
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
                    ->where([['anuncios.estado_anuncio','=','1'],['validez_anuncio','Activo']])
                    ->whereIn('users.id',$arr)
                    ->orderBy('users.valor_recarga','DESC')
                    ->orderBy('anuncios.id','DESC')
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
                ->where([['anuncios.estado_anuncio','=','1'],['validez_anuncio','Activo']])
                ->whereIn('users.id',$arr)
                ->orderBy('users.valor_recarga','DESC')
                ->orderBy('anuncios.id','DESC')
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
           //dd($arr_anuncios);
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
        $cambio_rol=false;
        //verificar si no tiene anuncios se debe cambiar el rol a Anunciante
        $ad=Anuncio::where('id_user',auth()->user()->id)->get();
        if(count($ad)>=0 && !auth()->user()->hasRole('Admin')){
          auth()->user()->removeRole('Usuario');
          auth()->user()->assignRole('Anunciante');
          $cambio_rol=true;
        }
        $dt=$request->get('data');
        $can_ad=0;
        $last=Anuncio::where('id','>','1')->orderBy('id','DESC')->first();
        
        foreach ($dt['tramites'] as $key => $value) {
            Anuncio::insert(["codigo_anuncio"=>"t".time().(string)($can_ad+1),
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
            $msn=" un nuevo anuncio, una vez sea verificado que cumpla con nuestra política, serás notificado y el anuncio será publicado.";
        }else{
            $msn=$can_ad." nuevos anuncios, una vez sean verificados que cumplan con nuestra política, serás notificado y los anuncios serán publicados.";
        }

        NotificacionAnuncio::dispatch(auth()->user(),["Hemos registrado ".$msn],auth()->user()->valor_recarga,"AnuncioCreado");

        $uadmin=User::role('admin')->get();

        foreach ($uadmin as $key => $value) {
          NotificacionAnuncio::dispatch($value,["Hemos registrado ".$msn],auth()->user()->valor_recarga,"AnuncioCreadoAdmin");
        }

        return response()->json(["respuesta"=>true,"mensaje"=>"Hemos registrado ".$msn,"cambio_rol"=>$cambio_rol]);

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
                ->orderBy('validez_anuncio','DESC')
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
                ->orderBy('estado_anuncio','DESC')
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
        
            CompartirCodigo::dispatch(auth()->user(),$re["correos"]);

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
                  ->update(['calificacion'=>$data["nota"],
                            'estado_pago'=>'TRANSACCION FINALIZADA',
                            'opinion'=>$data["opinion"],
                            'comentario'=>$data["opinion"],
                            'updated_at'=>Carbon::now('America/Bogota')]);

          $dtc=DB::table('registro_pagos_anuncios')
              ->where('id',$data['id_anuncio_calificar'])
              ->get();

          $an=Anuncio::where("anuncios.id",$dtc[0]->id_anuncio)
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
                      //dd($an);
          User::where("id",$an[0]->user_id)->increment("nota",$data['nota']);
          User::where("id",$an[0]->user_id)->increment("num_calificaciones",1);
          $admin=User::role('admin')->get();  
          //CORREO A LOS ADMINISTARDOR
          foreach ($admin as $key => $value) {
            //dd($value);
            NotificacionAnuncio::dispatch($value,
                            [User::where('id',$an[0]->id_user)->first(),
                            $an[0],
                            ['url'=>config('app.url').'/admin/todas_las_transacciones?id='.$dtc[0]->transactionId],
                            ['mensaje'=>""]],
                            0,
                            "NotificarTramiteFinalizadoAdmin");
          
          }

          //correo al tramitador
          $u=User::where("id",$an[0]->id_user)->first();
          
          NotificacionAnuncio::dispatch($u,
                            [$an[0],
                            ['url'=>config('app.url').'/admin/ver_mis_ventas/'.$u->id.'?id='.$dtc[0]->transactionId],
                            ['mensaje'=>""]],
                            0,
                            "NotificarTramiteCalificacion");
          
          return response()->json(["respuesta"=>true,'mensaje' => 'Se ha registrado tu calificación, gracias por confiar en '.config('app.name')]);
      
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
                NotificacionAnuncio::dispatch(User::where('id',$ad[0]->id_user)->first(), [$ad[0]],auth()->user()->valor_recarga,"AnuncioHabilitado");
                $estado_anuncio="Activo";
            }elseif($estado=='2'){
              
                $est='Bloqueado';
                NotificacionAnuncio::dispatch(User::where('id',$ad[0]->id_user)->first(), [$ad[0]],auth()->user()->valor_recarga,"AnuncioBloqueado");
                $estado_anuncio="Bloqueado";
            }
              //dd($est);
            Anuncio::where("id",$id)->update(["validez_anuncio"=>$est]);


            return response()->json(["estado"=>$estado_anuncio]);


        }else{
            if($estado=="1"){
                $est='1';
                NotificacionAnuncio::dispatch(User::where('id',$ad[0]->id_user)->first(), [$ad[0]],auth()->user()->valor_recarga,"AnuncioHabilitado");
                $estado_anuncio="Activo";
            }else{
                $est='0';
                NotificacionAnuncio::dispatch(User::where('id',$ad[0]->id_user)->first(), [$ad[0]],auth()->user()->valor_recarga,"AnuncioDeshabilitado");
                $estado_anuncio="Inactivo";
            }
        }

        

        Anuncio::where("id",$id)->update(["estado_anuncio"=>$est]);



        return response()->json(["estado"=>$estado_anuncio]);
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
                $est='Bloqueado';
                /*NotificacionAnuncio::dispatch($us_ad[0], [$ad[0]],auth()->user()->valor_recarga,"AnuncioDeshabilitado");]*/
                NotificacionAnuncio::dispatch($us_ad[0], [$ad[0]],$us_ad[0]->valor_recarga,"AnuncioBloqueado");

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
          return response()->json(["tramites"=>Tramite::join('anuncios','anuncios.id_tramite','tramites.id')->where([['anuncios.estado_anuncio','1'],['anuncios.validez_anuncio','Activo']])->groupby('nombre_tramite')->orderBy('nombre_tramite')->get(),"ciudades"=>Anuncio::select('ciudad')->where([['estado_anuncio','1'],['validez_anuncio','Activo']])->orderBy('ciudad')->groupby('ciudad')->get()]);
          //return response()->json(["tramites"=>Tramite::all(),"ciudades"=>Ciudad::all()]);

    }
    public function datos_ciudades($tramite){
       return response()->json(["ciudades"=>Anuncio::join('tramites','tramites.id','anuncios.id_tramite')->select('ciudad')->where([['anuncios.estado_anuncio','1'],['anuncios.validez_anuncio','Activo'],['tramites.nombre_tramite',$tramite]])->orderBy('ciudad')->groupby('ciudad')->get()]);
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
