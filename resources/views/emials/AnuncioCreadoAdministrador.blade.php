@component('mail::message')


![logo](http://tutramitador.com/core/img/logo.png)

Estimad@ {{$user->nombre}}, hemos registrado que uno de los usuario ha creado anuncios, te invitamos a que los verifiques y publiques

#[Sitio web][1]
[1]:{{$url}}#



Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
