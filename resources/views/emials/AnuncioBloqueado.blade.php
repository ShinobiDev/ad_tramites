@component('mail::message')

# {{ config('app.name')}} #

{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}

Estimad@ {{$user->nombre}}, se ha bloqueado uno de tus anuncios en {{config('app.name')}}


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

Estado: BLOQUEADO

Recuerda que debes tener saldo en la cuenta de recargas para que los usuarios puedan
ver tus datos de contacto.

## BALANCE DE RECARGA ##
$ {{number_format($recarga,0,'.','.')}} 

#[Recarga][1]
[1]:{{$url}}#


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent