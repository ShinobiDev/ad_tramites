@component('mail::message')


![logo]({{config('app.url')}}/img/logo.png)

Estimad@ {{$user->nombre}}, han visto tu anuncio en  {{ config('app.name')}}

## Usuario que ha visto tu anuncio ##

## Nombre : {{$ad[1]->nombre}}
## Teléfono: {{$ad[1]->telefono}}
## Email: {{$ad[1]->email}}

## Resumen Oferta ##

Anuncio:

# Tramite
 {{$ad[0]->nombre_tramite}}
# Ciudad
 {{$ad[0]->ciudad}}
# Valor tramite
 $ {{number_format($ad[0]->valor_tramite,0,'.','.')}}
# Descripción del anuncio
 {{$ad[0]->descripcion_anuncio}}

Estado: ACTIVO

## BALANCE DE RECARGA ##
$ {{number_format($recarga,0,'.','.')}} 

#[Recarga][1]
[1]:{{$url}}#

  No dejes agotar tu recarga, para que puedan seguir viendo tu anuncio.


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
