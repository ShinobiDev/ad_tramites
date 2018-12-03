<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
       'App\Events\NotificacionAnuncio' =>[
            'App\Listeners\SendNotification',    
        ],
        'App\Events\UserWasCreated' => [
            'App\Listeners\SendLoginCredencials',
        ],
        'App\Events\CompartirCodigo' =>[
            'App\Listeners\SendShareMail',
        ],        
         'App\Events\ActualizacionDatos' =>[
            'App\Listeners\SendActualizacionDatos',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
