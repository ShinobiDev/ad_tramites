@component('mail::message')


![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad@ {{$user->nombre}}, ya han pasado tres dias desde que se realizo el pago de tu tramite, debido a que no se realizo ninguna confirmación, se ha cerrado dicha transacción en tu {{config('app.name')}}



## Resumen Oferta ##

# Anuncio:

# Trámite 
 {{$ad[0]->nombre_tramite}}
# Ciudad 
 {{$ad[0]->ciudad}} 


# Número de transacción :{{$ad[3]}}


#[Ver trámite][1]
[1]:{{$ad[1]}}


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent