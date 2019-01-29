@extends('layouts.app')
@section('head')

@endsection
@section('header')
    <h1>
        Mis compras
    </h1>
    <small>Listado</small>

    <ol class="breadcrumb">
      <li><a href="{{route('welcome')}}"><i class="fa fa-dashboard">  Inicio</i></a></li>
      <li class="active">Ingresos</li>
    </0l>

@endsection

@section('content')

  <div class="container-fluid">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Listado de compras realizadas</h3>
      </div>
      <div class="box-body">
          <table id="compras-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Tipo</th>
                <th>Trámite</th>
                <th>Vendedor</th>
                <th>Teléfono tramitador</th>
                <th>E-mail tramitador</th>
                <th>Estado compra</th>
                
                <th>Valor comprado</th>
                <th>Referecia de pago</th>
                <th>Fecha transacción</th>
                
                <th>Acción</th>  
              </tr>
            </thead>
            <tbody>
              
              @foreach ($mis_compras as $compra)
                  <tr>      
                    <td>compra</td>          
                    <td>{{$compra->nombre_tramite}}</td>   
                    <td>{{$compra->nombre}}</td>          
                    <td>{{$compra->telefono}}</td>          
                    <td>{{$compra->email}}</td>          
                    <td>
                      @if($compra->estado_pago=="PENDIENTE")
                        PENDIENTE POR PAGO
                      @elseif($compra->estado_pago=="APROBADA")
                        PAGO ACEPTADO
                      @elseif($compra->estado_pago=="TRAMITE REALIZADO")  
                        TRÁMITE REALIZADO
                      @elseif($compra->estado_pago=="TRANSACCION FINALIZADA" || $compra->estado_pago=="PAGO A TRAMITADOR" || $compra->estado_pago=="PAGO TRAMITADOR CONFIRMADO")  
                        TRANSACCIÓN FINALIZADA
                      @elseif($compra->estado_pago=="RECHAZADA")  
                         COMPRA RECHAZADA
                      @endif
                    </td>                      
                                                       
                                                      
                    <td>$ {{number_format($compra->transation_value,0,',','.')}}</td>                                    
                    <td>{{$compra->transactionId}}</td>
                    <td>{{$compra->updated_at}}</td>
                   
                    <td>
                          
                      @if($compra->estado_pago=="APROBADA")
                        <button id="{{'btn_cal_'.$compra->id_pago}}" type="button" class="btn btn-primary" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_notificar_tramitador'.$compra->id_pago}}','{{$compra->id_pago}}','0',false)" >
                            Notificar al tramitador
                        </button>
                        @if($compra->calificacion==null)

                          <button id="{{'btn_cal_'.$compra->id_pago}}" type="button" class="btn btn-success" data-toggle="modal" onclick="descontar_recargar('{{ 'infocalificar'.$compra->id_pago}}','{{$compra->id_pago}}','0',false)" >
                              Confirmar trámite
                          </button>
                          
                        @endif  


                      @elseif($compra->estado_pago=="TRANSACCION FINALIZADA"  || $compra->estado_pago=="PAGO A TRAMITADOR" || $compra->estado_pago=="PAGO TRAMITADOR CONFIRMADO")     
                        @for($i=1;$i<=$compra->calificacion;$i++)
                          @if($i<=5)
                            <img  class="star" src="{{asset('img/star.png')}}">
                          @endif
                        @endfor
                      @endif
                    </td>                                   
                     
                                                      
                  </tr>
              @endforeach

            </tbody>
          </table>
          <!--VENTANAS -->
           @foreach ($mis_compras as $compra)                 
                          
                      @if($compra->estado_pago=="APROBADA")                       
                        @include('partials.notificar_tramitador',['ad'=>$compra])                        
                        @if($compra->calificacion==null)                         
                          @include('partials.btn_calificar_anunciante_venta_realizada',['ad'=>$compra])
                        @endif                   
                        
                      @endif
           @endforeach
          
      </div>
      
        
 
    </div>
  </div>



@endsection

@section('scripts')
          
          <script>
            $(document).ready(function() {
                console.log("5");
                $('#compras-table').DataTable( {
                    responsive: true,
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
                filtro_url('#compras-table');


            });
          </script>
       
            
@endsection




