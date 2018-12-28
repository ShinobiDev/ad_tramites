@component('mail::message')
# {{ config('app.name')}} #


{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}


##Utiliza estas credenciales para acceder a {{config('app.name')}}##

@component('mail::table')
    | Usuario | Contraseña |
    |:--------|:----------|
    | {{$user->email}} | {{$password}} |
@endcomponent

@component('mail::button', ['url' => url('login')])
Login
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
