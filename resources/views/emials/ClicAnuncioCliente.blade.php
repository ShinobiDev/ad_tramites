@component('mail::message')


![logo]({{config('app.url')}}/img/logo.png)

Estimad@ {{$user->nombre}}, haz visto un anuncio en  {{ config('app.name')}}

## Tramitador ##

## Nombre : {{$ad[1]->nombre}}
## Teléfono: {{$ad[1]->telefono}}
## Email: {{$ad[1]->email}}

## Resumen Oferta ##

# Anuncio:

# Trámite
 {{$ad[0]->nombre_tramite}}
# Ciudad
 {{$ad[0]->ciudad}}
# Valor trámite
 $ {{number_format($ad[0]->valor_tramite,0,'.','.')}}
# Descripción del anuncio
 {{$ad[0]->descripcion_anuncio}}



#[Sitio web][1]
[1]:{{$url}}#

  


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
