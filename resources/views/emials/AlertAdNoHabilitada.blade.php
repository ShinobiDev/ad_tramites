@component('mail::message')
# {{ config('app.name')}} #

{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}

Estimad@ {{$user->name}}, Se ha registrado un cambio en tu criptomoneda,
actualmente no se encuentra activa, te sugerimos que cambies el estado de tu anuncio.

Recuerda comunicarte con nosotros para bridarte más información, visita nuesto sitio web

@component('mail::button', ['url' => url('config('app.url')')])
 Ir a la web
@endcomponent

## Resumen Oferta ##
Anuncio:

@component('mail::table')
    | tramite | valor tramite | divisa | 
    |:--------|:----------|
    | {{--$ad[1]->tipo_anuncio--}} | {{--$ad[1]->nombre_cripto_moneda--}} | {{--$ad[1]->nombre_moneda--}} | 
@endcomponent

Estado: ACTIVADO

Recuerda que debes tener saldo en la cuenta de recargas para que los usuarios puedan
ver tus datos de contacto.

## BALANCE DE RECARGA {{$recarga}} ##

#[Recarga][1]
[1]:{{$url}}#




Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
