@component('mail::message')


![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad@ {{$user->nombre}}, tenemos excelentes noticias, tu pago se ha realizado.


## Resumen Oferta ##

Anuncio:

# Trámite 
 {{$ad[1]->nombre_tramite}}
# Ciudad 
 {{$ad[1]->ciudad}} 
## Mensaje de tu tramitador ##
{{$ad[3]['mensaje']}}

## ***** Nota importante *****

## Recuerda que de no confirmar el pago durante los próximos tres dias, daremos por entendido que recibiste el pago y la transacción sera finalizada.


#[Confirmar pago][1]
[1]:{{$ad[2]['url']}}


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent