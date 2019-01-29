@component('mail::message')


![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad@ {{$user->nombre}}, hemos registrado que uno de los usuario ha creado anuncios, te invitamos a que los verifiques y publiques

#[Ir a {{config('app.name')}}][1]
[1]:{{$url}}#



Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
