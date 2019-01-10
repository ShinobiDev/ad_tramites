@component('mail::message')


![logo](http://tutramitador.com/core/img/logo.png)

Estimad@ {{$user->nombre}}, hemos registrado una compra pendiente falta que la confirme el comprador.

## Resumen Oferta ##

Anuncio:

# Tramite 
 {{$ad[1]->nombre_tramite}}
# Ciudad 
 {{$ad[1]->ciudad}} 
# Valor tramite 
 $ {{number_format($ad[1]->valor_tramite,0,'.','.')}}
# Descripción del anuncio
 {{$ad[1]->descripcion_anuncio}}



## Resumen Oferta ##
Anuncio:
Estado: PENDIENTE

#[Ver mis ventas][1]
[1]:{{$ad[2]['url']}}


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent