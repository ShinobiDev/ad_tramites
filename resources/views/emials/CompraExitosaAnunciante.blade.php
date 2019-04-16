@component('mail::message')


![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad@ {{$user->nombre}}, hemos registrado una nueva venta de un anuncio en  {{ config('app.name')}}

##COMPRADOR##
# Nombre Usuario : 
 {{$ad[0]->nombre}}
# Télefono: 
 {{$ad[0]->telefono}},
# Email: 
 {{$ad[0]->email}},


## Resumen Oferta ##

Anuncio:

# Trámite
 {{$ad[1]->nombre_tramite}}
# Ciudad
 {{$ad[1]->ciudad}}
# Valor trámite
@if($ad[3]['cupon']==false)
 $ {{number_format($ad[1]->valor_tramite,0,'.','.')}}
@else
  {{$ad[3]['cupon']}}
@endif 
# Descripción del anuncio
 {{$ad[1]->descripcion_anuncio}}

## ***** Nota importante *****
##Por favor comunicate con tu comprador para solicitarle los correspondientes documentos y de este modo realizar el trámite. 

Recuerda que debes tener saldo en la cuenta de recargas para que los usuarios puedan
ver tus datos de contacto.

## BALANCE DE RECARGA ##
$ {{number_format($recarga,0,'.','.')}} 


#[Notificar al comprador][1]
[1]:{{$ad[2]['url']}}



Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
