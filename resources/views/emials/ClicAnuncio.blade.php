@component('mail::message')


![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad@ {{$user->nombre}}, han visto tu anuncio en  {{ config('app.name')}}

## Usuario que ha visto tu anuncio ##

## Nombre : 
 {{$ad[1]->nombre}}
## Teléfono:
 {{$ad[1]->telefono}}
## Email: 
 {{$ad[1]->email}}

## Resumen Oferta ##

Anuncio:

# Trámite
 {{$ad[0]->nombre_tramite}}
# Ciudad
 {{$ad[0]->ciudad}}
# Valor trámite
 $ {{number_format($ad[0]->valor_tramite,0,'.','.')}}
# Descripción del anuncio
 {{$ad[0]->descripcion_anuncio}}

Estado: ACTIVO

## BALANCE DE RECARGA ##
$ {{number_format($recarga,0,'.','.')}} 

#[Recargar][1]
[1]:{{$url}}#

  No dejes agotar tu recarga, para que puedan seguir viendo tu anuncio.


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
