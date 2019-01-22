@component('mail::message')


![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad@ {{$user->nombre}}, Se ha realizado una nueva recarga Pendiente.

Recarga pendiente por valor: $ {{$recarga[1]['valor']}}  {{$recarga[1]['fecha']}}, solo falta que realices el pago.


## Resumen Oferta ##
Anuncio:
Estado: PENDIENTE DE APROBACION



## BALANCE DE RECARGA ##
$ {{number_format($recarga[0]->valor_recarga,0,',','.')}}

#[Recargar][1]
[1]:{{$url}}#


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
