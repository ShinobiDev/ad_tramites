@component('mail::message')


![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad@ {{$user->nombre}}, tus clic se esta agotando

## BALANCE DE RECARGA ##
$ {{number_format($recarga,0,'.','.')}} 

#[Recargar][1]
[1]:{{$url}}#

Gracias,<br>
{{ config('app.name') }}
@endcomponent
