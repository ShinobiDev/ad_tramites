@component('mail::message')


![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad@ {{$user->nombre}}, se ha registrado el cierre de una transacción en {{config('app.name')}}


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

# Número de transacción :{{$ad[3]}}

#[Ver trámite][1]
[1]:{{$ad[2]}}


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent