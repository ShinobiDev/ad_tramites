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

  <div class="container">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Listado de compras realizadas</h3>
      </div>
      <div class="box-body">
          <table id="compras-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Tipo</th>
                <th>Tramite</th>
                <th>Vendedor</th>
                <th>Estado compra</th>
                
                
                <th>Valor comprado</th>
                <th>Referecia de pago</th>
                <th>Fecha transacción</th>
                <th>Acción</th>  
              </tr>
            </thead>
            <tbody>
              {{--dd($mis_compras)--}}            
              @foreach ($mis_compras as $compra)
                  <tr>      
                    <td>compra</td>          
                    <td>{{$compra->nombre_tramite}}</td>   
                    <td>{{$compra->nombre}}</td>          
                    <td>
                      @if($compra->estado_pago=="PENDIENTE")
                        PENDIENTE POR PAGO
                      @else
                        {{$compra->estado_pago}}
                      @endif
                    </td>                                   
                                                       
                                                      
                    <td>$ {{number_format($compra->transation_value,0,',','.')}}</td>                                    
                    <td>{{$compra->transactionId}}</td>
                    <td>{{$compra->updated_at}}</td>
                    <td>
                      @if($compra->estado_pago=="APROBADA" && $compra->calificacion == null)
                          
                         <button id="{{'btn_cal_'.$compra->id}}" type="button" class="btn btn-primary" data-toggle="modal" onclick="descontar_recargar('{{ 'infocalificar'.$compra->id}}','{{$compra->id}}','0','compra')" >
                                                  Calificar
                                                </button>
                           @include('partials.btn_calificar_anunciante_venta_realizada',['ad'=>$compra])
                      @else    
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
 
      </div>
      
        
 
    </div>
  </div>



@endsection

@section('scripts')
          
          <script>
            $(document).ready(function() {
                console.log("5");
                $('#compras-table').DataTable( {
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




