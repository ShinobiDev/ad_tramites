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
use App\DetalleClicAnuncio;
use Illuminate\Support\Facades\DB;
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
       $horarios=DB::table('detalle_horario_usuario')->where('id_user',auth()->user()->id)->get();
       return view('admin.user.index')
                        ->with('users', $users)
                        ->with('horarios',$horarios)
                        ->with("recarga",Recargas::where("user_id",auth()->user()->id)->select("valor")
                        ->first());
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
       dd($data);


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
                    ->with('horarios',$horarios);                        
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

        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        $horarios=DB::table('detalle_horarios')->where('id_user',Auth()->user()->id)->get();
          
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

        

        //$this->authorize('Update', $user);
        //dd($request->validated());
        //dd($request);
        //dd($user);
        $uo=User::where("id",$user->id)->get();
        //dd($uo[0]->email);
        if($uo[0]->email!=$request["email"]){
            $msn="Hemos enviado un correo electrónico, a tu cuenta ".$request["email"].", por favor confirmalo para realizar los cambios de tu correo";
            $data=$request->validated();
            
            if(strlen($data['telefono']) < 7 ||  strlen($data['telefono']) > 13){
                $msn="Ingresa un número de télefono valido";
                return back()->with('error',$msn);                
            }   
            $arr["nombre"]=$data["nombre"];
            $arr["telefono"]=$data["telefono"];;
            if(array_key_exists("password", $data)){
                $arr["password"]=Hash::make($data["password"]);    
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
            if(strlen($dt['telefono']) < 7 ||  strlen($dt['telefono']) > 13){
                $msn="Ingresa un número de télefono valido";
                return back()->with('error',$msn);                
            }
            if(array_key_exists("password", $dt)){
                $dt["password"]=bcrypt($dt["password"]);    
            }    
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

                               ->where("detalle_referidos.id_referido",Auth()->user()->id)->get();
        return view('recargas.mis_bonificaciones')
                ->with('bonificaciones',$bonificaciones)
                ->with('success', 'Estas son tus bonificaciones');                        
                               
    }

    public function validar_codigo($cod){
        if($cod=="-"){
             return response()->json(["respuesta"=>true]);
        }
        $us=User::where("codigo_referido",$cod)->get();
        if(count($us)>0){
            return response()->json(["respuesta"=>true]);
        }
        return response()->json(["respuesta"=>false]);
    }

    public function cambio_clave(Request $request){
      //dd(bcrypt($request['password']));
      //dd($request);
      User::where("email",$request['email'])->update(['password'=>bcrypt($request['password'])]);
     return back()->with('success', 'Cambio realizado correctamente');

    }
    /*
     * Funcion que realiza consulta de los anuncios que ha clickeado el usuario
     * @return [type] [description]
     */
    public function anuncios_vistos_por_mi(){

       $ad_saw=DB::table('detalle_clic_anuncios')
                ->select('anuncios.id',
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
                        ['detalle_clic_anuncios.id_usuario',Auth()->user()->id],
                        ['anuncios.estado_anuncio','1']
                        ])
                ->get();

       $ad_arr=new Anuncio();
       $arr_anuncios = $ad_arr->ver_anuncios($ad_saw);
       
      //dd($arr_anuncios);
      return view('anuncios.mis_anuncios_vistos')
                ->with('anuncios',$arr_anuncios)
                ->with("tramites",Tramite::all())
                ->with('success', 'Aqui esta el listado de los clic que haz visto');         
    }


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

        $ad=Anuncio::where("id",$anuncio)->get();
        //dd($ad);
        //descuento al cliente solo si no es el anunciante
        if($ad[0]->id_user!=$user_id){
            User::where([
                    ["id","=",$ad[0]->id_user],
                    ["valor_recarga",">",0]
                    ])->decrement('valor_recarga',floatval($costo));
            $uu=User::where("id",$ad[0]->id_user)->get();
            $uc=User::where("id",$user_id)->get();

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
                                "created_at"=>Carbon::now('America/Bogota')
                            ]);
            }

            
            //dd($ad);
            //NotificacionAnuncio::dispatch($uu[0], [$ad[0],$uc[0]],$rc[0]->valor,"AnuncioClickeado");
        }
        //valido valor de recarga

        //dd($rc);
        if($uu[0]->costo_clic>0){
            if(($rc[0]->valor_recarga/$uu[0]->costo_clic)<20){
                //aqui envie el mail
                //NotificacionAnuncio::dispatch($uu[0], $ad,$rc[0]->valor,"RecargaCasiAgotada");
            }
        }


        $vi=true;
        if($costo > $rc[0]->valor_recarga){
            $vi=false;
            User::where("id",$ad[0]->user_id)->update(["status_recarga"=>"AGOTADA"]);
            //NotificacionAnuncio::dispatch($uu[0], $ad,$rc[0]->valor,"RecargaAgotada");
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


    }

     /**
     * Funcion para registrar los pagos de las recarags previos al el envio a payu
     * @param  [type] $id              [description]
     * @param  [type] $valor_recarga   [description]
     * @param  [type] $referencia_pago [description]
     * @return [type]                  [description]
     */
    public function registrar_recarga($id,$valor_recarga,$referencia_pago){
        $dt=DB::table('detalle_recargas')->where("referencia_pago",$referencia_pago)->get();
        if(count($dt)==0){
            DB::table('detalle_recargas')->insert([
                    'tipo_recarga' => "RECARGA",
                    'valor_recarga'=>$valor_recarga,
                    'referencia_pago'=>$referencia_pago,
                    'id_usuario'=>$id
                ]);
    
        }
        //dd($dt);
        return response()->json(["respuesta"=>true]);
        
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
}