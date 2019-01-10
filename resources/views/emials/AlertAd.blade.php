@component('mail::message')
# {{ config('app.name')}} #

{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}

Estimad@ {{$user->nombre}}, Tus clic se esta agotando

## BALANCE DE RECARGA ##
$ {{number_format($recarga,0,'.','.')}} 

#[Recarga][1]
[1]:{{$url}}#

Gracias,<br>
{{ config('app.name') }}
@endcomponent
