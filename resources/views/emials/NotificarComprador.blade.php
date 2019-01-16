@component('mail::message')


![logo](http://tutramitador.com/core/img/logo.png)

Estimad@ {{$user->nombre}}, la siguiente es información importante para realizar tu trámite

##VENDEDOR##

# Nombre: 
{{$ad[0]->nombre}}
# Télefono:
 {{$ad[0]->telefono}}
# Correo electrónico:
 {{$ad[0]->email}}

## Resumen Oferta ##

Anuncio:

# Trámite 
 {{$ad[1]->nombre_tramite}}
# Ciudad 
 {{$ad[1]->ciudad}} 
## Mensaje de tu tramitador ##
{{$ad[3]['mensaje']}}



#[Ver compra][1]
[1]:{{$ad[2]['url']}}


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent