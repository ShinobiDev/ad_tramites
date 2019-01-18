<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

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
                ->get();
        dd($pagos);
    }
}
