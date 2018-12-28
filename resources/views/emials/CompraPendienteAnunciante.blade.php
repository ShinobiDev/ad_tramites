@component('mail::message')


{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}

Estimad@ {{$user->name}}, Hemos registrado una nueva venta de un anuncio en # {{ config('app.name')}} #, sin  embargo aún esta pendiente por el pago de el comprador

##COMPRADOR##
Usuario : {{$ad[0]->name}}
Telefono: {{$ad[0]->phone}},
Email: {{$ad[0]->email}},


## Resumen Oferta ##
Anuncio:

@component('mail::table')
    | tramite | valor tramite | divisa | 
    |:--------|:----------|
    | {{--$ad[1]->tipo_anuncio--}} | {{--$ad[1]->nombre_cripto_moneda--}} | {{--$ad[1]->nombre_moneda--}} | 
@endcomponent

Recuerda que debes tener saldo en la cuenta de recargas para que los usuarios puedan
ver tus datos de contacto.

## BALANCE DE COMPRA {{$recarga}} ##


#[Sitio web][1]
[1]:{{$url}}#



Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
