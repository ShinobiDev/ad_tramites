@component('mail::message')


{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}

Estimad@ {{$user->nombre}}, hemos registrado una compra pendiente falta que la confirmes.

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




Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent