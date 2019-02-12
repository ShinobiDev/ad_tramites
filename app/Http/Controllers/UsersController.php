<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Events\UserWasCreated;
use App\Events\ActualizacionDatos;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Redirector;
use App\Payu;
use App\Anuncio;
use App\Tramite;
use App\Variable;
use App\DetalleClicAnuncio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Events\NotificacionAnuncio;
use Carbon\Carbon;




class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users = User::allowed()->get();
       $horarios=DB::table('detalle_horarios')->where('id_user',auth()->user()->id)->get();
       return view('admin.user.index')
                        ->with('users', $users)
                        ->with('horarios',$horarios)
                        ->with("recarga",auth()->user()->valor_recarga);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        $user = new User;

        $this->authorize('create', $user);

        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        return view('admin.user.create',compact('user', 'roles','permissions'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar usuario

        $this->authorize('create', new User);


        $data = $request->validate([
          'nombre' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'telefono'=> 'required|unique:users',
          'código_referido'=>''
        ]);
        //Generar contrarseña
       //dd($data);


        //return redirect()->route('users.index')->with('success','Se ha creado el usuario correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show(User $user)
    {
          //dd($user);

          //$this->authorize('view', $user);

          //$recargas = User::where('id',$user->id)->get();
          // dd($recargas);
          //dd(Payu::all());
          $pp=new Payu();
            if(config("app.debug")==true){
              $tipo="TEST";
            }else{
              $tipo="PRODUCTION";
            }
          $py=Payu::where("type",$tipo)->get();
          $ref=time()."-".date("s");
          $ad=[];
          $ref=time()."-".date("s");
          $ad=[];




          $horarios=DB::table('detalle_horarios')->where('id_user',Auth()->user()->id)->get();


           //dd($transacciones);
          return view('admin.user.show')->with('user', $user)
                    ->with('recargas', $user)
                    ->with("py",$py[0])
                    ->with("ref_code","rec_".$ref)
                    ->with("hash",$pp->hashear("rec_".$ref,20000,"COP"))
                    ->with('horarios',$horarios)
                    ->with('variables',Variable::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        //$this->authorize('update', $user);
        //dd($user->nombre);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        $horarios=DB::table('detalle_horarios')->where('id_user',$user->id)->get();

        return view('admin.user.edit',compact('user', 'roles','permissions'))->with("horarios",$horarios);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function confirma(Request $request, User $user){
    //
    //     $usr = User::where('email', $request->mail);
    //     foreach ($usrs as $us) {
    //       $clave = $us->password;
    //     }
    //
    //     $confirmas =  bcrypt($request->confirma);
    //     dd($confirmas);
    //     if ($request->confirmas == $clave) {
    //       // code...
    //     }
    //
    // }


    public function update(UpdateUserRequest $request, User $user)
    {
        //dd($request);
        $uo=User::where("id",$user->id)->get();
        //dd($uo[0]->email);
        if($uo[0]->email!=$request["email"]){
            $msn="Hemos enviado un correo electrónico, a tu cuenta ".$request["email"].", por favor confirmalo para realizar el cambio de tu correo";
            $data=$request->validated();

            if(strlen($data['telefono']) < 7 ||  strlen($data['telefono']) > 13){
                $msn="Ingresa un número de télefono valido";
                return back()->with('error',$msn);
            }
            $arr["nombre"]=$data["nombre"];
            $arr["telefono"]=$data["telefono"];
            if(array_key_exists("cuenta_bancaria", $data)){
              $arr["cuenta_bancaria"]=$data["cuenta_bancaria"];            
            }
            
            if(array_key_exists("password", $data)){
                $arr["password"]=bcrypt($data["password"]);
            }
            //dd($arr);
            if(filter_var($request["email"], FILTER_VALIDATE_EMAIL)){
                $uu=User::where("email",$request["email"])->get();
                if(count($uu)==0){
                    //dd($request["email"]);
                    ActualizacionDatos::dispatch($user,$request["email"]);
                }else{
                    $msn="No se ha podido registrar la cuenta de correo ".$request["email"].", está cuenta de correo, ya se encuentra registrada en nuestro sistema ";
                }

            }else{
                $msn="Ingresa una cuenta de correo valida";
            }



            $user->update($arr);

        }else{
            $dt=$request->validated();
            //dd($dt);
            if(strlen($dt['telefono']) < 7 ||  strlen($dt['telefono']) > 13){
                $msn="Ingresa un número de télefono valido";
                return back()->with('error',$msn);
            }
            if(array_key_exists("cuenta_bancaria", $dt)){

                $dt["cuenta_bancaria"]=$dt["cuenta_bancaria"];
                //dd($dt["cuenta_bancaria"]);
            }
            if(array_key_exists("password", $dt)){
                $dt["password"]=bcrypt($dt["password"]);
            }
            //dd($dt);
            $user->update($dt);
            $msn='Se ha actualizado el usuario correctamente';

        }



        return back()->with('success',$msn);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete',$user);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario Eliminado correctamente');
    }
    /**
     * Funcion para validar el cambio del correo
     * 
     * @param  [type] $id           [description]
     * @param  [type] $nuevo_correo [description]
     * @return [type]               [description]
     */
    public function cambio_correo($id,$nuevo_correo){
        if(filter_var($nuevo_correo, FILTER_VALIDATE_EMAIL)){
            $dd=User::where("id",$id)->get();
                if(count($dd)==1){
                    $ot_u=User::where("email",$nuevo_correo)->get();
                    if(count($ot_u)==0){
                        User::where("id",$id)->update(["email"=>$nuevo_correo]);
                        return redirect()->route('users.show',$id)->with('success', 'Hemos registrado este nuevo correo');
                    }else{
                        return redirect()->route('users.show',$id)->with('error', 'Verifica tu código de cambio para el correo, esta cuenta de correo ya existe');
                    }

                }else{
                    return redirect()->route('users.show',$id)->with('error', 'Verifica tu código de cambio para el correo');
                }
        }else{
            return redirect()->route('users.show',$id)->with('error', 'Verifica tu correo electrónico');
        }



    }
    /**
     * Funcion para consulatr las bonificaciones
     * @return [type] [description]
     */
    public function mis_bonificaciones(){
        $bonificaciones=DB::table("bonificaciones")
                               ->select('users.id',
                                          'users.nombre',
                                           'users.nombre',
                                           'users.email',
                                           'users.telefono',
                                           'users.valor_recarga',
                                           'users.costo_clic',
                                           'users.nota',
                                           'bonificaciones.tipo_bonificacion',
                                           'bonificaciones.valor_bonificacion',
                                           'bonificaciones.created_at')
                               ->join("detalle_referidos","detalle_referidos.id","bonificaciones.fk_id_detalle_referido")
                               ->join("users","users.id","detalle_referidos.id_referido")

                               ->where("detalle_referidos.id_cabeza",auth()->user()->id)->get();
        //dd($bonificaciones,auth()->user()->id);                       
        return view('recargas.mis_bonificaciones')
                ->with('bonificaciones',$bonificaciones)
                ->with('success', 'Estas son tus bonificaciones');

    }
    /**
     * Funcion para validar el código
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function validar_codigo(Request $request){
        //dd($request['data']['datos']);
        $cod=$request['data']['datos'];
        $us=User::where("codigo_referido",$cod)->get();
        if(count($us)>0){
            return response()->json(["respuesta"=>true]);
        }
        return response()->json(["respuesta"=>false,"mensaje"=>"Error Código referido: El Código de la persona que te refirio no existe. Deja el espacio vacío o pregúntaselo nuevamente."]);
    }
    /**
     * Funcion para cambiar la clave
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function cambio_pass(Request $request){

         User::where("email",$request['email'])
                        ->update([
                                  'password'=>bcrypt($request['password'])
                                ]);
         return redirect()->route('login',["id"=>$request['email']])->with('success', 'Se ha cambiado tu contraseña correctamente, debes ingresar con tu nueva contraseña');
    }
    /*
     * Funcion que realiza consulta de los anuncios que ha clickeado el usuario
     * @return [type] [description]
     */
    public function anuncios_vistos_por_mi(){
        //dd(auth()->user()->id);
       $ad_saw=DB::table('detalle_clic_anuncios')
                ->select('anuncios.id',
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
                             "users.nombre",
                             "users.telefono",
                             "users.email",
                             "users.costo_clic",
                             "users.valor_recarga",
                             "tramites.nombre_tramite",
                             DB::Raw("FORMAT(users.nota/users.num_calificaciones,1) as calificacion") )
                ->join('anuncios','anuncios.id','detalle_clic_anuncios.id_anuncio')
                ->join('users','users.id','anuncios.id_user')
                ->join('tramites','tramites.id','anuncios.id_tramite')
                ->where([
                        ['detalle_clic_anuncios.id_usuario',auth()->user()->id],
                        ['anuncios.estado_anuncio','1']
                        ])
                ->get();
        //dd($ad_saw);
       $ad_arr=new Anuncio();
       $arr_anuncios = $ad_arr->ver_anuncios($ad_saw);
       $tramites=Tramite::select('tramites.id','tramites.nombre_tramite')
                                ->join('anuncios','tramites.id','anuncios.id_tramite')
                                ->join('detalle_clic_anuncios','anuncios.id','detalle_clic_anuncios.id_anuncio')
                                ->where([
                                    ['detalle_clic_anuncios.id_usuario',auth()->user()->id],
                                    ['anuncios.estado_anuncio','1']
                                ])
                                ->groupby("tramites.id")
                                ->get();
      //dd($arr_anuncios);
      return view('anuncios.mis_anuncios_vistos')
                ->with('anuncios',$arr_anuncios)
                ->with("tramites",$tramites)
                ->with('success', 'Aquí está el listado de los anuncios que haz visto');
    }




    /**
     * Funcion para cambiar el horario de un cliente
     * @param  [type] $id       [description]
     * @param  [type] $horarios [description]
     * @return [type]           [description]
     */
   public function cambiar_horario( $id,$horarios){
        //dd($horarios);
        DB::table('detalle_horarios')->where('id',$id)->update([
                                                                    'horario'=>$horarios
                                                                ]);
        return response()->json(["respuesta"=>true]);
    }

    /*
    aqui se registra el clic dado a un anuncio

    $anuncio = id anuncio
    $costo = valor de el clic
    $user_id = id quien da clic
    $tipo de clic info o compra
    */
    public function  registro_consulta_ad($anuncio,$costo,$user_id,$tipo)
    {
      $ad=Anuncio::select('anuncios.id',
                          'anuncios.valor_tramite',
                          'descripcion_anuncio',
                          'ciudad',
                          'tramites.nombre_tramite',
                          'anuncios.id_user'
                          )
                  ->where("anuncios.id",$anuncio)
                  ->join('tramites','tramites.id','anuncios.id_tramite')
                  ->get();

        if(auth()->user()->hasRole('Anunciante') || auth()->user()->hasRole('Usuario')){

          //dd($ad);
          //descuento al cliente solo si no es el anunciante
          if($ad[0]->id_user!=$user_id){
              User::where([
                      ["id","=",$ad[0]->id_user],
                      ["valor_recarga",">",0]
                      ])->decrement('valor_recarga',floatval($costo));
              $tramitador=User::where("id",$ad[0]->id_user)->get();
              $cliente=User::where("id",$user_id)->get();
              //dd($tramitador,$cliente);
             /*Registro la consulta realizada*/
              $rc=User::select("valor_recarga")
                  ->where("id",$ad[0]->id_user)
                  ->get();


              $us_clic=DetalleClicAnuncio::where([
                                              ["id_usuario",$user_id],
                                              ["id_anuncio",$ad[0]->id]
                                          ])
                                      ->get();
              /*
              aqui valido si el registr ya existe y en ese caso le agrego el numero de visitas y le actualizo la fecha
               */
              //echo Carbon::now('America/Bogota');
              //echo count($us_clic);
              if(count($us_clic)>0){
                  //dd($us_clic);
                  DetalleClicAnuncio::where([
                                              ["id_usuario",$user_id],
                                              ["id_anuncio",$ad[0]->id]
                                            ])->increment("num_visitas",1);

                  DetalleClicAnuncio::where([["id_usuario",$user_id],["id_anuncio",$ad[0]->id]])
                                      ->update(["id_usuario"=>$user_id,

                                                  "updated_at"=>Carbon::now('America/Bogota')

                                              ]);
                   DetalleClicAnuncio::where([
                                              ["id_usuario",$user_id],
                                              ["id_anuncio",$ad[0]->id]

                                          ])->increment("num_visitas",1);


              }else{

                  DetalleClicAnuncio::create([
                                  "id_anuncio"=>$ad[0]->id,
                                  "id_usuario"=>$user_id,
                                  "costo"=>$costo,
                                  "num_visitas"=>1,
                                  "created_at"=>Carbon::now('America/Bogota'),
                                  "updated_at"=>Carbon::now('America/Bogota')
                              ]);
              }


              //dd($ad,$cliente,$rc);
              NotificacionAnuncio::dispatch($tramitador[0], [$ad[0],$cliente[0]],$rc[0]->valor_recarga,"AnuncioClickeado");
              NotificacionAnuncio::dispatch($cliente[0], [$ad[0],$tramitador[0],["url"=>config('app.url')."/admin/anuncios_vistos?id=".$ad[0]->id."-"]],0,"AnuncioClickeadoCliente");
          }
          //valido valor de recarga

          //dd($rc);
          if($tramitador[0]->costo_clic>0){
              if(($rc[0]->valor_recarga/$tramitador[0]->costo_clic)< 20 && ($rc[0]->valor_recarga/$tramitador[0]->costo_clic) > 0 ){
                  //aqui envie el mail
                  NotificacionAnuncio::dispatch($uu[0], $ad,$rc[0]->valor_recarga,"RecargaCasiAgotada");
              }
          }


          $vi=true;
          if(($rc[0]->valor_recarga/$tramitador[0]->costo_clic)< 0){
              $vi=false;
              User::where("id",$ad[0]->user_id)->update(["status_recarga"=>"AGOTADA"]);
              NotificacionAnuncio::dispatch($tramitador[0], $ad,$rc[0]->valor,"RecargaAgotada");
          }

          if(floatval($rc[0]->valor_recarga)>0){
              return response()->json(["respuesta"=>true,
                                      "ad_visible"=>$vi,
                                      "limite_clic"=>$rc[0]->valor_recarga]);
          }else{
               return response()->json(["respuesta"=>false,
                                      "ad_visible"=>$vi,
                                      "limite_clic"=>$rc[0]->valor_recarga]);
          }
        }else{
          //dd($ad[0]);
          $rc=User::select("valor_recarga")
              ->where("id",$ad[0]->id_user)
              ->get();
          return response()->json(["respuesta"=>true,
                                  "ad_visible"=>true,
                                  "limite_clic"=>$rc[0]->valor_recarga]);
        }


    }

     /**
     * Funcion para registrar los pagos de las recargas previos al el envio a payu
     * @param  [type] $id              [description]
     * @param  [type] $valor_recarga   [description]
     * @param  [type] $referencia_pago [description]
     * @return [type]                  [description]
     */
    public function registrar_recarga($id_user,$valor_recarga,$referencia_pago){
        return response()->json(User::generar_registro_recarga_en_bd($id_user,$valor_recarga,$referencia_pago)[0]);

    }
    /**
     * Funcion para cambiar el estado del dia
     * @param  [type] $id     [description]
     * @param  [type] $estado [description]
     * @return [type]         [description]
     */
    public function cambiar_estado_dia($id,$estado){

        if($estado=="false"){
            $estado2='Cerrado';
        }else{
            $estado2='Abierto';
        }
        DB::table('detalle_horarios')->where('id',$id)->update([
                                                                    'estado'=>$estado2
                                                                   ]);
        //dd($estado2);
        return response()->json(["respuesta"=>true,"estado"=>$estado2]);
    }

    public function ver_recargas(){
        $recargas = User::select('users.id',
                                    'users.nombre',
                                    'users.fecha_ultima_recarga',
                                    'users.status_recarga',
                                    'users.valor_recarga',
              //                      'detalle_recargas.updated_at',
                                    'users.costo_clic')
            //->join('detalle_recargas','detalle_recargas.id_usuario','users.id')
            //->groupBy('users.id')
            //->orderBy('detalle_recargas.updated_at','users.id')
            ->get();
        $mi_lista=User::select('users.id',
                                'users.nombre',
                                'users.fecha_ultima_recarga',
                                'detalle_recargas.tipo_recarga',
                                'detalle_recargas.estado_detalle_recarga',
                                'detalle_recargas.valor_recarga',
                                'detalle_recargas.referencia_pago',
                                'detalle_recargas.referencia_pago_pay_u',
                                'detalle_recargas.created_at')
                            ->join('detalle_recargas','detalle_recargas.id_usuario','users.id')
                              ->orderBy('users.id')
                            ->where("users.id",$recargas[0]->id)
                            ->get();

        return view('recargas.index')->with('recargas' , $recargas)->with("mi_lista_recarga",$mi_lista);

    }

    public function cambiar_costo_clic(Request $request){

        User::where("id",">",0)->update([
                    'costo_clic' => $request["valor"]
                ]);


        return redirect()->route('recargas.show', auth()->user())->with('success', 'Se ha cambiado el costo del clic para todos los usuarios');
    }

    public function mostrar_cambiar_costo_clic(){
        return view('recargas.create');

    }

    public function registro_recargas(){
        //dd($_REQUEST);
        $u = new User;
        return $u->registro_recargas($_REQUEST);

    }
    /*
      Funcion para editar variables generales
     */
    public function editar_variables(Request $request){
        //dd($request);
        Variable::where('nombre',$request['nombre'])
                 ->update([
                            'valor'=>$request['valor']
                          ]);

        return back()->with('success', 'Se ha cambiado el valor de la variable correctamente');
    }
     public function ver_recargas_mis_recargas($id){
        $mi_lista=User::select('users.id',
                                    'users.nombre',
                                    'detalle_recargas.tipo_recarga',
                                    'detalle_recargas.estado_detalle_recarga',
                                    'detalle_recargas.valor_recarga',
                                    'detalle_recargas.referencia_pago',
                                    'detalle_recargas.referencia_pago_pay_u',
                                    'detalle_recargas.updated_at'
                                    ,'detalle_recargas.created_at')
                            ->join('detalle_recargas','detalle_recargas.id_usuario','users.id')
                            ->orderBy('users.id')       
                            ->where("users.id",$id)    
                            ->get();   
         //dd($mi_lista);                   
         return response()->json(["respuesta"=>true,
                                    "datos"=>$mi_lista,
                                    "mensaje"=>"Se ha consultado los datos"]);                    
    }

     /**
     * Funcion para consultar las compras que ha realizado un usuario
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function ver_mis_compras($id){
        
        $pag=DB::table('registro_pagos_anuncios')->select('registro_pagos_anuncios.id as id_pago',
                           'registro_pagos_anuncios.transactionId',
                           'registro_pagos_anuncios.transactionState',
                           'registro_pagos_anuncios.transation_value',
                           'registro_pagos_anuncios.id_anuncio',
                           'registro_pagos_anuncios.id_user_compra',
                           'registro_pagos_anuncios.metodo_pago',
                           'registro_pagos_anuncios.estado_pago',
                           'registro_pagos_anuncios.opinion',
                           'registro_pagos_anuncios.calificacion',
                           'registro_pagos_anuncios.created_at',
                           'registro_pagos_anuncios.updated_at',
                           'tramites.nombre_tramite',
                           'anuncios.id', 
                           'anuncios.codigo_anuncio',
                           'anuncios.ciudad',
                           'users.id as id_anunciante',
                           'users.nombre',
                           'users.email',
                           'users.telefono')
                    ->join('anuncios','anuncios.id','registro_pagos_anuncios.id_anuncio')
                    ->join('users','users.id','anuncios.id_user')
                    ->join('tramites','anuncios.id_tramite','tramites.id')
                    ->where([
                                ['id_user_compra',$id],
                                ['registro_pagos_anuncios.transactionId','!=',null]
                            ])
                    ->orderBy('registro_pagos_anuncios.updated_at','DESC')
                    ->get();
        //dd([$pag,auth()->user()->name]);
        return view('anuncios.mis_compras')
                ->with('mis_compras',$pag);
                   

    }
    /**
     * Funcion para rconsultar las ventas que ha realizado
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function ver_mis_ventas($id){
        $pag=DB::table('registro_pagos_anuncios')->select('registro_pagos_anuncios.id as id_pago',
                           'registro_pagos_anuncios.transactionId',
                           'registro_pagos_anuncios.transactionState',
                           'registro_pagos_anuncios.transation_value',
                           'registro_pagos_anuncios.id_anuncio',
                           'registro_pagos_anuncios.id_user_compra',
                           'registro_pagos_anuncios.metodo_pago',
                           'registro_pagos_anuncios.estado_pago',
                           'registro_pagos_anuncios.created_at',
                           'registro_pagos_anuncios.updated_at',
                           'registro_pagos_anuncios.opinion',
                           'registro_pagos_anuncios.calificacion',
                           'registro_pagos_anuncios.porcentaje_pago',
                           'tramites.nombre_tramite',
                           'anuncios.codigo_anuncio',
                           'anuncios.ciudad',
                           'users.id as id_anunciante',
                           'users.nombre',
                           'users.email',
                           'users.telefono')
                    ->join('anuncios','anuncios.id','registro_pagos_anuncios.id_anuncio')
                    ->join('users','users.id','registro_pagos_anuncios.id_user_compra')
                    ->join('tramites','anuncios.id_tramite','tramites.id')
                    ->where([
                                ['anuncios.id_user',$id],
                                ['registro_pagos_anuncios.transactionId','!=',null]
                            ])
                    ->orderBy('registro_pagos_anuncios.updated_at','DESC')
                    ->get();
      
        return view('anuncios.mis_ventas')
                ->with('porcentaje',Variable::where('nombre','porcentaje_tramite')->get())  
                ->with('mis_ventas',$pag);
        
    }
    /**
     * Funcion para notificar los documentos requeridos al comprador
     * @return [type] [description]
     */
    public  function notificar_comprador(Request $request){
      
      $comprador=User::where('id',$request['id_user_compra'])->first();
     
      $pago=DB::table('registro_pagos_anuncios')->where('id',$request['id_pago'])->first();
      
      NotificacionAnuncio::dispatch($comprador,
                            [auth()->user(),
                            Anuncio::where('anuncios.id',$request['id_anuncio'])->join('tramites','tramites.id','anuncios.id_tramite')->select('tramites.nombre_tramite','anuncios.ciudad')->first(),
                            ['url'=>config('app.url').'/admin/ver_mis_compras/'.$comprador->id.'?id='.$pago->transactionId],
                            ['mensaje'=>$request['mensaje']]],
                            0,
                            "NotificarComprador");

      return back()->with('success','Notificación enviada a tu cliente correctamente');
    }
   
     /**
     * Funcion para notificar los documentos requeridos al comprador
     * @return [type] [description]
     */
    public  function notificar_tramitador(Request $request){
      
      $tramitador=User::where('id',$request['id_user_ad'])->first();
     
      $pago=DB::table('registro_pagos_anuncios')->where('id',$request['id_pago'])->first();
      
      NotificacionAnuncio::dispatch($tramitador,
                            [auth()->user(),
                            Anuncio::where('anuncios.id',$request['id_anuncio'])->join('tramites','tramites.id','anuncios.id_tramite')->select('tramites.nombre_tramite','anuncios.ciudad')->first(),
                            ['url'=>config('app.url').'/admin/ver_mis_ventas/'.$tramitador->id.'?id='.$pago->transactionId],
                            ['mensaje'=>$request['mensaje']]],
                            0,
                            "NotificarTramitador");
      return back()->with('success','Notificación enviada a tu tramitador correctamente');
    }

    public function notificar_tramite_finalizado(Request $request){
      //dd($request);
      $comprador=User::where('id',$request['id_user_compra'])->first();
     
      $pago=DB::table('registro_pagos_anuncios')->where('id',$request['id_pago'])->first();
      //dd($comprador);
      $ad=Anuncio::where('anuncios.id',$request['id_anuncio'])->join('tramites','tramites.id','anuncios.id_tramite')->select('tramites.nombre_tramite','anuncios.ciudad','anuncios.id_user')->first();
      NotificacionAnuncio::dispatch($comprador,
                            [auth()->user(),
                            $ad,
                            ['url'=>config('app.url').'/admin/ver_mis_compras/'.$comprador->id.'?id='.$pago->transactionId],
                            ['mensaje'=>$request['mensaje']]],
                            0,
                            "NotificarTramiteFinalizado");

      //pendiente envio email a administrador
      $admin=User::role('admin')->get();  
      
      foreach ($admin as $key => $value) {
        NotificacionAnuncio::dispatch($value,
                            [User::where('id',$ad->id_user)->first(),
                            $ad,
                            ['url'=>config('app.url').'/admin/todas_las_transacciones?id='.$pago->transactionId],
                            ['mensaje'=>""]],
                            0,
                            "NotificarTramiteFinalizadoAdmin");
      }
                
      return back()->with('success','Notificación enviada a tu cliente correctamente');
    }
    
    public function todas_las_transacciones(){
    
      if(auth()->user()->roles[0]->name=='Admin'){
           $transacciones=DB::table('registro_pagos_anuncios')
                            ->select('registro_pagos_anuncios.id as id_pago',
                                   'registro_pagos_anuncios.transactionId',
                                   'registro_pagos_anuncios.transactionState',
                                   'registro_pagos_anuncios.transation_value',
                                   'registro_pagos_anuncios.id_anuncio',
                                   'registro_pagos_anuncios.id_user_compra',
                                   'registro_pagos_anuncios.metodo_pago',
                                   'registro_pagos_anuncios.estado_pago',
                                   'registro_pagos_anuncios.opinion',
                                   'registro_pagos_anuncios.calificacion',
                                   'registro_pagos_anuncios.created_at',
                                   'registro_pagos_anuncios.updated_at',
                                   'registro_pagos_anuncios.porcentaje_pago',
                                   'tramites.nombre_tramite',
                                   'anuncios.id', 
                                   'anuncios.codigo_anuncio',
                                   'anuncios.ciudad',
                                   'users.id as id_anunciante',
                                   'users.nombre',
                                   'users.email',
                                   'users.cuenta_bancaria',
                                   'users.telefono')
                            ->join('anuncios','anuncios.id','registro_pagos_anuncios.id_anuncio')
                            ->join('users','users.id','anuncios.id_user')
                            ->join('tramites','anuncios.id_tramite','tramites.id')
                            ->orderBy('registro_pagos_anuncios.updated_at','DESC')
                            ->get();
        //dd($transacciones);                    
        return view('anuncios.todas_las_transacciones')
                  ->with('transacciones',$transacciones)
                  ->with('porcentaje',DB::table('variables')->where('nombre','porcentaje_tramite')->get());
      }else{
        return back();
      }
     


    }
    /**
     * Funcion para notificar al tramitador del pago hecho por tu tramitador
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function notificar_pago_a_tramitador(Request $request){
      //dd($request);
      $tramitador=User::where('id',$request['id_user_compra'])->first();
      $porcentaje_actual=Variable::where('nombre','porcentaje_tramite')->first();
      //regitro el porcentaje conq ue se realizo el pago al tramitador
      DB::table('registro_pagos_anuncios')
                  ->where('id',$request['id_pago'])
                  ->update([
                            'porcentaje_pago'=>$porcentaje_actual->valor,
                            "estado_pago"=>'PAGO A TRAMITADOR'
                          ]);

      $pago=DB::table('registro_pagos_anuncios')
                  ->where('id',$request['id_pago'])
                  ->first();
      //dd($comprador);
      NotificacionAnuncio::dispatch($tramitador,
                            [auth()->user(),
                            Anuncio::where('anuncios.id',$request['id_anuncio'])->join('tramites','tramites.id','anuncios.id_tramite')->select('tramites.nombre_tramite','anuncios.ciudad')->first(),
                            ['url'=>config('app.url').'/admin/ver_mis_ventas/'.$tramitador->id.'?id='.$pago->transactionId],
                            ['mensaje'=>$request['mensaje']],
                            ['valor'=>$request['valor']]],
                            0,
                            "NotificarPagoTramitador");
      return back()->with('success','Notificación enviada al tramitador correctamente');
    }
    /**
     * Funcion para registrar el pago hecho por tu tramitador
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function notificar_pago_de_tramitador(Request $request){
      //dd($request);
      $tramitador=User::where('id',$request['id_anunciante'])->first();
      DB::table('registro_pagos_anuncios')
              ->where('id',$request['id_pago'])
              ->update(["estado_pago"=>'PAGO TRAMITADOR CONFIRMADO']);
      $pago=DB::table('registro_pagos_anuncios')->where('id',$request['id_pago'])->first();
      $ad=Anuncio::where('anuncios.id',$pago->id_anuncio)
                ->join('tramites','tramites.id','anuncios.id_tramite')->select('tramites.nombre_tramite','anuncios.ciudad')->first();
      //dd($ad);          
      NotificacionAnuncio::dispatch($tramitador,
                            [auth()->user(),
                            $ad,
                            ['url'=>config('app.url').'/admin/ver_mis_ventas/'.$tramitador->id.'?id='.$pago->transactionId],
                            ['mensaje'=>$request['mensaje']],
                            ['valor'=>$request['valor']]],
                            0,
                            "NotificarPagoTramitador");
      return back()->with('success','Gracias por confiar en '.config('app.name'));
    }

    /**
     * Funcion paraaregistrar la certificacion bancaria
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actualizar_certificacion_bancaria(Request $request,$id){
        $this->validate(request(),[
            'file'=>'required|max:10240|mimetypes:application/pdf'
        ]);
        $filename = $request->file('file')->move('archivos/'.$id);
          $newname="/certificacion_bancaria.".explode(".",$_FILES['file']['name'])[1];
        rename($filename,realpath(dirname($filename)).$newname);

        User::where('id',$id)
                ->update([
                        'certificacion_bancaria'=>'/archivos/'.$id."".$newname
                    ]);
                
        
        return  response()->json(['respuesta'=>true,'mensaje'=>'Se ha registrado tu certificación bancaria']);                       
        
    }

}
