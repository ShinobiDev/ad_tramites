@component('mail::message')
# {{ config('app.name')}} #

{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}

Estimad@ {{$user->name}}, Tu saldo de recarga se esta agotando.

Recuerda que debes tener saldo en tu cuenta de recargas para que
los usurarios puedan ver tus datos de contacto.

## BALANCE DE RECARGA{{$recarga}} ##

#[Recarga][1]
[1]:{{$url}}#

Gracias,<br>
{{ config('app.name') }}
@endcomponent
