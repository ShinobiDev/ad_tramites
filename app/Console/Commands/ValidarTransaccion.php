<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Carbon\Carbon;
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
                ->where('estado_pago','PAGO A TRAMITADOR')    
                ->whereDate('updated_at',Carbon::now()->subDays('3')->format('Y-m-d'))
                ->get();
        //dd($pagos);        
        foreach ($pagos as $key => $value) {
              //var_dump($value->estado_pago);      
              
              DB::table('registro_pagos_anuncios')
                ->where('id',$value->id)
                ->update([
                        "estado_pago"=>'PAGO TRAMITADOR CONFIRMADO'
                    ]);    
        }       

                
        
    }
}
