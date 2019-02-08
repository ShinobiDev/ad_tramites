@component('mail::message')


![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad@ {{$user->nombre}}, se ha realizado una nueva recarga.

Recarga pendiente por valor: $ {{number_format($recarga[1]['valor'],0,',','.')}}, solo falta que realices el pago.


## Resumen Oferta ##
Anuncio:
Estado: PENDIENTE DE APROBACIÓN



## BALANCE DE RECARGA ##
$ {{number_format($recarga[0]->valor_recarga,0,',','.')}}

#[Recargar][1]
[1]:{{$url}}#


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
