@component('mail::message')


![logo](http://tutramitador.com/core/img/logo.png)

Estimad@ {{$user->nombre}}, se ha realizado una nueva transacción en {{config('app.name')}}


# Nombre tramitador: 
{{$ad[0]->nombre}}
# Télefono:
 {{$ad[0]->telefono}}
# Correo electrónico:
 {{$ad[0]->email}}

## Resumen Oferta ##

# Anuncio:

# Trámite 
 {{$ad[1]->nombre_tramite}}
# Ciudad 
 {{$ad[1]->ciudad}} 
## Mensaje de tu tramitador ##
{{$ad[3]['mensaje']}}



#[Ver trámite][1]
[1]:{{$ad[2]['url']}}


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent