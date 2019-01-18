@extends('layouts.app')
@section('head')
@endsection
@section('header')
    <h1>
        Mis ventas
    </h1>
    <small>Listado</small>

    <ol class="breadcrumb">
      <li><a href="{{route('welcome')}}"><i class="fa fa-dashboard">Inicio</i></a></li>
      <li class="active">Ingresos</li>
    </ol>
@endsection

@section('content')
  
  <div class="container">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Listado de ventas realizadas</h3>
      </div>
      <div class="box-body">
          <table id="ventas-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Tipo</th>    
                <th>Trámite</th>      
                <th>ventador</th>
                <th>Estado venta</th>
                <th>Valor vendido</th>
                <th>Referecia de pago</th>
                <th>Fecha transacción</th>
                <th>Calificación</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($mis_ventas as $venta)
                  {{--dd($venta)--}}
                  <tr>                   
                    <td>venta</td>   
                    <td>{{$venta->nombre_tramite}}</td>   
                    <td>{{$venta->nombre}}</td>
                    <td>
                      @if($venta->estado_pago=="PENDIENTE")
                        PENDIENTE POR PAGO
                      @elseif($venta->estado_pago=="APROBADA")
                        PAGO ACEPTADO
                      @elseif($venta->estado_pago=="TRAMITE REALIZADO")  
                        TRÁMITE REALIZADO
                      @elseif($venta->estado_pago=="TRANSACCION FINALIZADA" || $venta->estado_pago=="PAGO A TRAMITADOR")  
                        TRANSACCIÓN FINALIZADA
                      @elseif($venta->estado_pago=="RECHAZADA")  
                         VENTA RECHAZADA
                      @endif
                    </td>
                  
                    <td>$ {{number_format($venta->transation_value,0,',','.')}}</td>                                    
                    <td>{{$venta->transactionId}}</td>                                   
                    <td>{{$venta->updated_at}}</td>
                    <td> @for($i=1;$i<=$venta->calificacion;$i++)
                          @if($i<=5)
                            <img  class="star" src="{{asset('img/star.png')}}">
                          @endif
                        @endfor
                    </td> 
                    <td>
                      @if($venta->estado_pago=="APROBADA")
                        <button id="{{'btn_cal_'.$venta->id_pago}}" type="button" class="btn btn-primary" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_notificar_comprador'.$venta->id_pago}}','{{$venta->id_pago}}','0',false)" >
                            Notificar al comprador
                        </button>
                        @include('partials.notificar_comprador',['ad'=>$venta])


                        <button id="{{'btn_cal_'.$venta->id_pago}}" type="button" class="btn btn-success" data-toggle="modal" onclick="descontar_recargar('{{ 'notificar_tramite_finalizado_comprador'.$venta->id_pago}}','{{$venta->id_pago}}','0',false)" >
                            Notificar tramite realizado
                        </button>
                        @include('partials.notificar_tramite_finalizado_comprador',['ad'=>$venta])
                      
                      @elseif($venta->estado_pago=="TRANSACCION FINALIZADA" )  
                        <button id="{{'btn_cal_'.$venta->id_pago}}" type="button" class="btn btn-success" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_pago_de_tramitador'.$venta->id_pago}}','{{$venta->id_pago}}','0',false)" >
                            Confirmar pago de {{config('app.name')}}
                        </button>
                        @include('partials.confirmar_pago_de_tramitador',['ad'=>$venta])
                      @elseif( $venta->estado_pago=="PAGO A TRAMITADOR")
                       TRANSACCION FINALIZADA
                      @endif
                    </td>       
                  </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>


@endsection

@section('scripts')

          <script>
              $(document).ready(function() {
              $('#ventas-table').DataTable( {
                  dom: 'Bfrtip',
                  buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                  language:
                    {
                      "sProcessing":     "Procesando...",
                      "sLengthMenu":     "Mostrar _MENU_ registros",
                      "sZeroRecords":    "No se encontraron resultados",
                      "sEmptyTable":     "Ningún dato disponible en esta tabla",
                      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                      "sInfoPostFix":    "",
                      "sSearch":         "Buscar:",
                      "sUrl":            "",
                      "sInfoThousands":  ",",
                      "sLoadingRecords": "Cargando...",
                      "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "Último",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                      },
                      "oAria": {
                          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                      }
                  }
              } );
              filtro_url('#ventas-table');

            });
          </script>
           
@endsection
@include('partials.scripts')
<script type="text/javascript">
  function cambiar_valor_clic(id){
     peticion_ajax("get","cambiar_valor_clic/"+id+"/"+document.getElementById("rec_"+id).value,function(rs){
        console.log(rs);
     });
  }
</script>

<script type="text/javascript">
  function ver_bonificaciones(id){
     peticion_ajax("get","ver_bonificaciones_mis_bonificaciones/"+id,function(rs){
        console.log(rs);
        var ls=document.getElementById("tbl_mis_lista");
        ls.innerHTML="";
        for(var f in rs.datos){
          var tr=document.createElement("tr");
          var td=document.createElement("td");
          td.innerHTML=rs.datos[f].id;
          tr.appendChild(td);

          
          var td=document.createElement("td");
          td.innerHTML=rs.datos[f].nombre;
          tr.appendChild(td);

          
          var td=document.createElement("td");
          td.innerHTML=rs.datos[f].valor_bonificacion;
          tr.appendChild(td);

          
          var td=document.createElement("td");
          td.innerHTML=rs.datos[f].estado_detalle_bonificacion;
          tr.appendChild(td);

          
          var td=document.createElement("td");
          td.innerHTML=rs.datos[f].referencia_pago;
          tr.appendChild(td);

          
          var td=document.createElement("td");
          td.innerHTML=rs.datos[f].created_at;
          tr.appendChild(td);
          ls.appendChild(tr);  
        }

     });
  }

</script>
