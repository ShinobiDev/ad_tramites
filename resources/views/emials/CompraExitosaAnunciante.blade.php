@component('mail::message')


{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}

Estimad@ {{$user->nombre}}, hemos registardo una nueva venta de un anuncio en  {{ config('app.name')}} 

##COMPRADOR##
Usuario : {{$ad[0]->nombre}}
Telefono: {{$ad[0]->telefono}},
Email: {{$ad[0]->email}},


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

Recuerda que debes tener saldo en la cuenta de recargas para que los usuarios puedan
ver tus datos de contacto.

## BALANCE DE COMPRA $ {{$recarga}} ##


#[Sitio Web][1]
[1]:{{$url}}#



Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
