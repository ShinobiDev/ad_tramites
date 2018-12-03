@extends('layouts.app')


@section('content')

<div class="container">
    <div class="marco">

        <div class="contenedor">
            <h2>METALBIT</h2>
            <div class="left">
                <h4 class="rj">{{$respuesta['referenceCode']}}</h4>
                <h4 class="rj">Estado de la transacción: {{$estado}}</h4>
                <h4 class="rj">Entidad: {{$entidad}}</h4>
                <h5>{{$empresa[0]->razon_social}}</h5>
                <h5>Nit {{$empresa[0]->nit}}</h5>
                <h5>Telefono: {{$empresa[0]->tel_contacto}}</h5>

            </div>
            <div class="rigth">
                <h4 class="rj">Cliente</h4>
                <h5>{{$cliente[0]->name}}</h5>

            </div>
        </div>
        <div class="contenedor">
            <div class="descripcion">
                <h5>{{($respuesta["description"])}}</h5>
                <label>{{$respuesta["TX_VALUE"]}}</label>
                <br>
                <h5>Iva</h5>
                <label>{{$respuesta['TX_TAX']}}</label>
                <br>
                <h5>Total</h5>
                <label class="rj">{{$respuesta['TX_VALUE']}}</label>
            </div>
        </div>
        <div class="contenedor">
            <p>Nota de Información adicional que se deseé mostrar</p>

            <a href="{{route('anuncios.index')}}" class="btn btn-default">Volver</a>
            <input type="button" value="Imprimir" class="btn" onclick="imprimir()">
        </div>

    </div>
    <script type="text/javascript">
        function imprimir(){
             window.print();
        }

    </script>
</div>
@endsection
