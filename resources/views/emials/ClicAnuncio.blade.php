@component('mail::message')


{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}

Estimad@ {{$user->name}}, Han visto tu anuncio en  {{ config('app.name')}} 

Usuario : {{$ad[1]->name}}
Telefono: {{$ad[1]->phone}},
Email: {{$ad[1]->email}},

## Resumen Oferta ##
Anuncio:

@component('mail::table')
    | tramite | valor tramite | divisa | 
    |:--------|:----------|
    | {{--$ad[1]->tipo_anuncio--}} | {{--$ad[1]->nombre_cripto_moneda--}} | {{--$ad[1]->nombre_moneda--}} | 
@endcomponent

## BALANCE DE RECARGA {{$recarga}} ##

#[Recarga][1]
[1]:{{$url}}#

  No dejes agotar tu recarga, para que puedan seguir viendo tu anuncio.


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
