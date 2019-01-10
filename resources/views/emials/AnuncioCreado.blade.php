@component('mail::message')

# {{ config('app.name')}} #

{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}

Estimad@ {{$user->nombre}}

{{$ad[0]}}

Tus anuncios seran verificados para garantizar que cumplas nuestras politicas de uso, una vez termine este proceso te informaremos la activación o bloqueo del anuncio


Recuerda que debes tener saldo en la cuenta de recargas para que los usuarios puedan
ver tus datos de contacto.

## BALANCE DE RECARGA ##
$ {{number_format($recarga,0,'.','.')}} 


#[Recarga][1]
[1]:{{$url}}#



Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
