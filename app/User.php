<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Anuncio;
use Carbon\Carbon;
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
        /*dd([
            $hora[0],
            strtotime($hora[0]),
            $hora[1],
            strtotime($hora[1]),
            $hora_actual->format('H:i'),
            strtotime($hora_actual->format('H:i')),
            $horarios[0]->estado            ]);*/
        //echo "<br>";
        
        //dd(strtotime($hora_actual->format('H:i')) > strtotime($hora[1]));
        if($horarios[0]->estado == "Cerrado"){
            return array("respuesta"=>false,"horarios"=>$horarios[0]);
        }
        if( (strtotime($hora_actual->format('H:i')) >= strtotime($hora[0])) && (strtotime($hora_actual->format('H:i')) <= strtotime($hora[1])) ) {

            return array("respuesta"=>true,"horarios"=>$horarios[0]);
        } 
        return array("respuesta"=>false,"horarios"=>$horarios[0]);
        
        
    }

    public function anuncios(){
        $this->hasMany(Anuncio::class);
    }
}
