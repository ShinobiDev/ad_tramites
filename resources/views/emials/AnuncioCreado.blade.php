@component('mail::message')

![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad@ {{$user->nombre}}

Tus anuncios seran verificados para garantizar que cumplas nuestras politicas de uso, una vez termine este proceso se publicara dicho anuncio


Recuerda que debes tener saldo en la cuenta de recargas para que los usuarios puedan
ver tus datos de contacto.

## BALANCE DE RECARGA ##
$ {{number_format($recarga,0,'.','.')}} 


#[Recargar][1]
[1]:{{$url}}#



Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
