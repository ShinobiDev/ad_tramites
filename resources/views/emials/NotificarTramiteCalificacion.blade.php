@component('mail::message')


![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad@ {{$user->nombre}}, han calificado, tu servicio en {{config('app.name')}}


## Resumen Oferta ##

# Anuncio:

# Trámite 
 {{$ad[0]->nombre_tramite}}
# Ciudad 
 {{$ad[0]->ciudad}} 


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}

#[Ver trámite][1]
[1]:{{$ad[1]['url']}}


@endcomponent