@component('mail::message')


![logo](http://tutramitador.com/core/img/logo.png)

Estimad@ {{$user->nombre}}, algo esta sucediendo con la app.




## RESUMEN ERROR ##

{{$error}}

#[ir a la web][1]
[1]:config('app.url')#
 


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
