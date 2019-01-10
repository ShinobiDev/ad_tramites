@component('mail::message')


![logo](http://tutramitador.com/core/img/logo.png)

Estimad@ {{$user->nombre}}, hemos registrado una compra pendiente falta que la confirmes.

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



## Resumen Oferta ##
Anuncio:
Estado: PENDIENTE

#[Ver mis compras][1]
[1]:{{$ad[1]['url']}}


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
