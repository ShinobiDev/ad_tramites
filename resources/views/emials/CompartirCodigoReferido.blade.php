@component('mail::message')


{{--![logo](http://metalbit.co/core/img/AzulMetalicoHor.png)--}}

Hola, soy {{$user->nombre}}, quiero invitarte a que te inscribas en ##{{ config('app.name')}} ##

debes seguir las instrucciones para registarte.


#[Registrate aquí][1]
[1]:{{$url}}  


Gracias, por seguir confiando en nosotros<br>
{{ config('app.name') }}
@endcomponent
