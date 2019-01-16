@component('mail::message')


![logo](http://tutramitador.com/core/img/logo.png)

Estimad@ {{$user->nombre}}, hemos registrado una nueva venta de un anuncio en  {{ config('app.name')}}

##COMPRADOR##
Usuario : {{$ad[0]->nombre}}
Telefono: {{$ad[0]->telefono}},
Email: {{$ad[0]->email}},


## Resumen Oferta ##

Anuncio:

# Trámite
 {{$ad[1]->nombre_tramite}}
# Ciudad
 {{$ad[1]->ciudad}}
# Valor trámite
 $ {{number_format($ad[1]->valor_tramite,0,'.','.')}}
# Descripción del anuncio
 {{$ad[1]->descripcion_anuncio}}

Por favor comunicate con tu comprador para solicitarle los correspondientes documentos y de este modo realizar el debido trámite. 

Recuerda que debes tener saldo en la cuenta de recargas para que los usuarios puedan
ver tus datos de contacto.

## BALANCE DE RECARGA ##
$ {{number_format($recarga,0,'.','.')}} 


#[Notificar al comprador][1]
[1]:{{$ad[2]['url']}}



Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
