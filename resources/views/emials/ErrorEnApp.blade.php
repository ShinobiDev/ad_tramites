@component('mail::message')


![logo](http://tutramitador.com/core/img/logolarge.png)

Estimad(@) {{$user->nombre}}, se ha presentado un error en la App por favor verifica los sucedido



@component('mail::button', ['url' => url(config('app.url'))])
 Ir a la web
@endcomponent

## Resumen Error ##

@component('mail::table')
    | error |
    |:--------|
    | {{$ad}}  |
@endcomponent






Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
