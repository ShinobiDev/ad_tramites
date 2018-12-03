<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Events\UserWasCreated;
use Illuminate\Support\Facades\Auth;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any a//dditional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {     
        /*//dd(Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => '',
            'telefono'=>'required|unique:users',
            'codigo_referido'=>''
        ]));*/
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => '',
            'telefono'=>'required|unique:users',
            'codigo_referido'=>''
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
          
        //dd($data);
        //
        $referente=[];
        if($data['codigo_referido']!=""){
            $referente=User::where('codigo_referido',$data['codigo_referido'])->get();        
        }
        //echo "0";
        $data['password'] = str_random(8);
        $cod=User::select("codigo_referido")->orderBy("codigo_referido","DESC")->limit(1)->get();
        ////dd($cod[0]->codigo_referido);
        ////dd(((int)$cod[0]->codigo_referido+1));
        //echo "1";
        $u = User::create([
            'nombre' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'telefono'=>$data['telefono'],
            'costo_clic'=>"50",
            'codigo_referido'=>((int)$cod[0]->codigo_referido+1),
            'valor_recarga'=>'0',
            'status_recarga'=>'ACTIVA',
            'nota'=>0

        ]);
        //echo "2";
         DB::table('detalle_horarios')->insert([
                                        [
                                            'id_user'=>$u->id,
                                            'dia'=>'LUNES'


                                        ],
                                        [
                                            'id_user'=>$u->id,
                                            'dia'=>'MARTES'

                                        ],
                                        [
                                            'id_user'=>$u->id,
                                            'dia'=>'MIERCOLES'

                                        ]
                                        ,
                                        [
                                            'id_user'=>$u->id,
                                            'dia'=>'JUEVES'


                                        ],
                                        [
                                            'id_user'=>$u->id,
                                            'dia'=>'VIERNES'

                                        ],
                                        [
                                            'id_user'=>$u->id,
                                            'dia'=>'SABADO'

                                        ],
                                        [
                                            'id_user'=>$u->id,
                                            'dia'=>'DOMINGO'

                                        ]
                                    ]);
         
        if(count($referente)>0){
            ////echo "3";
            ////dd($referente[0]);
            ////dd([$referente[0]->id,$u->id]);
          //Enviar Emial            
            //echo "4";
            DB::table("detalle_recargas")->insert([
                                                'id_usuario' => $referente[0]->id,
                                                'valor_recarga'=>100,
                                                "referencia_pago"=>time().$u->id,
                                                 "referencia_pago_pay_u"=>time().$u->id,
                                                 "metodo_pago"=>"BONIFICACION REGISTRO REFERIDO ",
                                                 "tipo_recarga"=>"BONIFICACION"
                                                    ]
                                            );
            //echo "4";
            DB::table("detalle_referidos")->insert([
                                                'id_cabeza' => $referente[0]->id,
                                                'id_referido'=>$u->id
                                                    ]);  
            //echo "6";
            $dt_r=DB::table('detalle_referidos')->where([['id_cabeza',$referente[0]->id],['id_referido',$u->id]])->get();    
            ////dd($);
            //echo "7";
            DB::table('bonificaciones')->insert(
                                     ["tipo_bonificacion"=>"REGISTRO",
                                      "fk_id_detalle_referido"=>$dt_r[0]->id,
                                      "valor_bonificacion"=>100   ]);
            //echo "8";
            User::where("id",$referente[0]->id)->increment("valor_recarga",100);
            //echo "9";
            ////dd($referente[0]);
        }
        //echo "10";
        //dd($referente);

        UserWasCreated::dispatch($u, $data['password']);

        
    }

      public function create_landing($codigo_referido){
        $u=User::where("codigo_referido",$codigo_referido)->limit(1)->get();
        if(count($u)>0){
            return view("admin.user.create_landing")
                ->with("codigo_referido",$codigo_referido)
                ->with("user",$u[0]);
        }else{
            return view("home");
                
        }
        
    }
}
