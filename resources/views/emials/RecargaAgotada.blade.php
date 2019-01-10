@component('mail::message')


![logo](http://tutramitador.com/core/img/logo.png)

Estimad@ {{$user->nombre}}, tu saldo de recarga se agoto.


Recuerda que debes tener saldo en la cuenta de recargas para que los usuarios puedan
ver tus datos de contacto.

## BALANCE DE RECARGA ##
$ {{number_format($recarga,0,'.','.')}} 

#[Recarga][1]
[1]:{{$url}}#
  No dejes agotar tu recarga, para que puedan seguir viendo tu anuncio.


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
