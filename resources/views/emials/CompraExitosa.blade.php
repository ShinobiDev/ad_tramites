@component('mail::message')


{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}

Estimad@ {{$user->nombre}}, Hemos registrado una compra exitosa en  {{ config('app.name')}}.


Por favor comunicate con tu comprador, para que se complete la transacción.

##VENDEDOR##

Nombre: {{$ad[0]->nombre}}
Télefono: {{$ad[0]->telefono}}
Correo electrónico: {{$ad[0]->email}}

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


Estado transacción: APROBADA




Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
