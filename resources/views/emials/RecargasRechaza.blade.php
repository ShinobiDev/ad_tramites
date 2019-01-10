@component('mail::message')


{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}

Estimad@ {{$user->nombre}}, Se ha realizado una nueva recarga Pendiente.

Recarga rechazada por valor: $ {{$recarga[1]['valor']}}  {{$recarga[1]['fecha']}}, solo falta que realices el pago


## Resumen Oferta ##
Anuncio:
Estado: RECHAZADA

Recuerda que debes tener saldo en la cuenta de recargas para que los usuarios puedan
ver tus datos de contacto.

## BALANCE DE RECARGA ##
$ {{ number_format($recarga[0]->valor_recarga,0,'.',',')}}

#[Recargar][1]
[1]:{{$url}}#


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
