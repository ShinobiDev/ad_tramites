<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use App\User;
use Carbon\Carbon;
use App\Events\NotificacionAnuncio;

class ValidarTransaccion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ValidarTransaccion:ValidarTransaccion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para validar que las transacciones finalizadas y donde se ha realizado el pago al tramitador, luego de tres dias se deberan cerrar ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $pagos=DB::table('registro_pagos_anuncios')
                 ->select('registro_pagos_anuncios.id as id_pago',
                           'users.id',
                           'users.nombre',
                           'users.email',
                           'users.telefono',
                           'tramites.nombre_tramite',
                           'anuncios.ciudad',
                            'registro_pagos_anuncios.transactionId')   
                ->join('anuncios','anuncios.id','registro_pagos_anuncios.id_anuncio')    
                ->join('tramites','tramites.id','anuncios.id_tramite')    
                ->join('users','users.id','anuncios.id_user')    
                ->where('registro_pagos_anuncios.estado_pago','PAGO A TRAMITADOR')    
                ->whereDate('registro_pagos_anuncios.updated_at',Carbon::now()->subDays('3')->format('Y-m-d'))
                ->get();
        //dd($pagos);        
        foreach ($pagos as $key => $value) {
                
              
                   DB::table('registro_pagos_anuncios')
                    ->where('id',$value->id_pago)
                    ->update([
                            "estado_pago"=>'PAGO TRAMITADOR CONFIRMADO'
                        ]);  
                //selecciono administradores
                $uadmin=User::role('admin')->get();

                $tramitador=User::where('id',$value->id)->get();
                foreach ($uadmin as $key => $admin) {

                       NotificacionAnuncio::dispatch($admin, [$tramitador[0],$value,config('app.url').'/admin/todas_las_transacciones?id='.$value->transactionId],0,"TransaccionFinalizadaAutomaticamenteAdministrador");  

                       
                } 
                //notificacion al comerciante
                NotificacionAnuncio::dispatch($tramitador[0], [$value,config('app.url').'/admin/ver_mis_ventas/'.$value->id.'/?id='.$value->transactionId],0,"TransaccionFinalizadaAutomaticamenteComerciante");       
         
        }       

                
        
    }
}
