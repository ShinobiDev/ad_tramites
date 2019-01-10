@component('mail::message')


![logo](http://tutramitador.com/core/img/logo.png)

Estimad@ {{$user->nombre}}, Hemos registrado una compra sin embargo ha sido rechazada, te solictamos verifiques con la entidad para que se verifique que esta sucediendo, si tienes alguna duda, puedes contactarnos en nuestro sitio web.



## Resumen Oferta ##
Anuncio:
Estado: RECHAZADA

Recuerda validar con tu entidad o medio de pago.



#[Sitio web][1]
[1]:{{$url}}#




Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
