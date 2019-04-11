@component('mail::message')


![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad@ {{$user->nombre}}, hemos registrado una compra exitosa en  {{ config('app.name')}}.


##VENDEDOR##

# Nombre usuario: 
{{$ad[0]->nombre}}
# Teléfono:
 {{$ad[0]->telefono}}
# Correo electrónico:
 {{$ad[0]->email}}

## Resumen Oferta ##

Anuncio:

# Trámite 
 {{$ad[1]->nombre_tramite}}
# Ciudad 
 {{$ad[1]->ciudad}} 
# Valor trámite 
 $ {{number_format($ad[1]->valor_tramite,0,'.','.')}}
@if($ad[3]['valor_venta']!=$ad[1]->valor_tramite)
# Valor pagado por el trámite 
	{{$ad[3]['valor_venta']}}
@endif

# Descripción del anuncio
 {{$ad[1]->descripcion_anuncio}}


# Estado transacción: APROBADA

#[ir a {{config('app.name')}}][1]
[1]:{{$ad[2]['url']}}


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
