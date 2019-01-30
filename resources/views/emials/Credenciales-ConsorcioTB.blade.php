@component('mail::message')



![logo](http://tutramitador.com/core/img/logolarge.png)


##Utiliza estas credenciales para acceder a {{config('app.name')}}##

@component('mail::table')
    | Usuario | Contraseña |
    |:--------|:----------|
    | {{$user->email}} | {{$password}} |
@endcomponent

@component('mail::button', ['url' => url('login')])
Iniciar sesión
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
