<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationMail extends Mailable
{

  public $user;
  public $ad;
  public $recarga;
  public $tipo;
  public $url;


    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $ad, $recarga,$tipo,$url)
    {
       //dd($this->tipo);
       $this->user = $user;
       $this->ad = $ad;
       $this->recarga = $recarga;
       $this->tipo = $tipo;
       $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this);
        switch ($this->tipo) {
            case 'AnuncioCreado':
                return $this->markdown('emials.AnuncioCreado')
                            ->subject('Has creado un nuevo anuncio '. config('app.name'));
                # code...
                break;
            case 'AnuncioCreadoAdmin':
                //dd($this);
                return $this->markdown('emials.AnuncioCreadoAdministrador')
                            ->subject('Se ha creado un nuevo anuncio '. config('app.name'));
                # code...
                break;
            case 'AnuncioClickeado':
                //dd($this);
                return $this->markdown('emials.ClicAnuncio')
                            ->subject( 'Tu anuncio ha sido clickeado '. config('app.name'));
                # code...
                break;
            case 'AnuncioClickeadoCliente':
                //dd($this);
                return $this->markdown('emials.ClicAnuncioCliente')
                            ->subject( 'Información del anuncio visto en  '. config('app.name'));
                # code...
                break;    
                
            case 'AnuncioHabilitado':
                return $this->markdown('emials.AnuncioActivado')
                            ->subject('Tu anuncio ha sido activado '. config('app.name'));
                # code...
                break;
            case 'AnuncioDeshabilitado':
                return $this->markdown('emials.AnuncioDesactivado')
                            ->subject('Tu anuncio ha sido desactivado '. config('app.name'));
                # code...
                break;
            case 'RecargaAgotada':
                return $this->markdown('emials.RecargaAgotada')
                            ->subject('Tu recarga se agoto '. config('app.name'));
                # code...
                break;
            case 'RecargaCasiAgotada':
                return $this->markdown('emials.RecargaAgotada')
                            ->subject('Tu recarga ya casi se  agota '. config('app.name'));
                # code...
                break;
            case 'RecargaExitosa':

                return $this->markdown('emials.RecargaExitosa')
                            ->subject('hemos registrado una nueva recarga '. config('app.name'));
                # code...
                break;
            case 'RecargaPendiente':
                return $this->markdown('emials.RecargaPendiente')
                            ->subject('Hemos registrado una nueva recarga, solo falta que la confirmes '. config('app.name'));
                # code...
                break;
            case 'RecargaRechazada':
                return $this->markdown('emials.RecargaRechazada')
                            ->subject('Hemos registrado una nueva recarga, sin embargo se ha rechazado '. config('app.name'));
                # code...
                break;
            case 'CompraExitosa':
                //dd($this);
                return $this->markdown('emials.CompraExitosa')
                            ->subject('Hemos registrado una nueva compra '. config('app.name'));
                # code...
                break;
            case 'CompraExitosaAnunciante':
               //dd($this->tipo);
                return $this->markdown('emials.CompraExitosaAnunciante')
                            ->subject('Hemos registrado una nueva compra para tu anuncio '. config('app.name'));
                # code...
                break;
            case 'CompraPendiente':
                //dd($this);
                return $this->markdown('emials.CompraPend')
                            ->subject('Hemos registrado una nueva compra, solo falta que la confirmes '. config('app.name'));
                # code...
                break;
            case 'CompraRechazada':
                return $this->markdown('emials.CompraRechazada')
                            ->subject('Hemos registrado una nueva compra, solo falta que la confirmes '. config('app.name'));
                # code...
                break;
            case 'CompraPendienteAnunciante':
            //dd($this);
                return $this->markdown('emials.CompraPendienteAnunciante')
                            ->subject('Hemos registrado una nueva compra en uno de tus anuncios '. config('app.name'));
                # code...
                break;
            case 'AnuncioBloqueado':
                    return $this->markdown('emials.AnuncioBloqueado')
                                ->subject('Algo pasa con tu anuncio  '. config('app.name'));
                    # code...
                    break;
            case "AnuncioPublicado":
                    //dd($this);
                    return $this->markdown('emials.AnuncioPublicado')
                                ->subject('Hemos publicado un nuevo anuncio tuyo en '. config('app.name'));
                    # code...
                    break;
             case "NotificarComprador":
                    //dd($this);
                    return $this->markdown('emials.NotificarComprador')
                                ->subject('Tienes un nuevo mensaje de '. config('app.name'));
                    # code...
                    break;
            case "NotificarTramitador":
                    return $this->markdown('emials.NotificarTramitador')
                                ->subject('Tienes un nuevo mensaje '. config('app.name'));
                    break;  
            case "NotificarTramiteFinalizado":
                    return $this->markdown('emials.NotificarTramiteFinalizado')
                                ->subject('Ya esta listo tu trámite en '. config('app.name'));
                    break; 
            case "NotificarTramiteFinalizadoAdmin":
                //dd($this);
                    return $this->markdown('emials.NotificarTramiteFinalizadoAdmin')
                                ->subject('Hemos registrado una transacción exitosa en '. config('app.name'));
                    break;   
            case "NotificarPagoTramitador":
                    //dd("-",$this);
                    return $this->markdown('emials.NotificarPagoTramitador')
                                ->subject('Ya esta listo tu pago en '. config('app.name'));
                    break;        
            case "NotificarTramiteCalificacion":
                    //dd($this);
                    return $this->markdown('emials.NotificarTramiteCalificacion')
                                ->subject('Te han calificado en '. config('app.name'));    
                    break;       
            case 'TransaccionFinalizadaAutomaticamenteAdministrador':
                     //dd($this);   
                    return $this->markdown('emials.TransaccionFinalizadaAutomaticamenteAdministrador')
                                ->subject('Transacción cerrada automaticamente en'. config('app.name'));    
                    break;                                  
            case 'TransaccionFinalizadaAutomaticamenteComerciante':
                    //dd($this->user);
                    return $this->markdown('emials.TransaccionFinalizadaAutomaticamenteComerciante')
                                ->subject('Transacción cerrada automaticamente en'. config('app.name'));    
                    break;                                          
            default:
                dd(["sin case=>",$this->tipo]);
                # code...
                break;
        }

    }
}
