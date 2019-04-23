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
      <div class="col-12 col-md-12 box-body"> 
          <table id="compras-table" class="table table-bordered table-striped">
            <thead>
              <tr class="bg-primary">
                <th>Tipo</th>
                <th>Estado compra</th>
                <th>Trámite</th>
                <th>Vendedor</th>
                <th>Teléfono tramitador</th>
                <th>E-mail tramitador</th>
                <th class="col-lg-2 col-2  col-md-2 col-sm-3" >Valor pagado por el trámite</th>
                <th class="col-lg-2 col-2  col-md-2 col-sm-3" >Valor real trámite</th>
                <th>Referecia de pago</th>
                <th>Fecha transacción</th>                
                <th>Acción</th>  
              </tr>
            </thead>
            <tbody>
              
              @foreach ($mis_compras as $compra)
                  <tr id="row_{{$compra->id_pago}}">      
                    <td class="text-success">compra</td>         
                    <td class="bg-info">
                      @if($compra->estado_pago=="PENDIENTE")
                        <span class="text-warning">Pendiente por pago del cliente</span>
                      @elseif($compra->estado_pago=="APROBADA")
                        <span class="text-primary">Pago del cliente aceptado</span>
                      @elseif($compra->estado_pago=="TRAMITE REALIZADO")  
                        <span class="text-info">Trámite realizado</span>
                      @elseif($compra->estado_pago=="TRANSACCION FINALIZADA" || $compra->estado_pago=="PAGO A TRAMITADOR" || $compra->estado_pago=="PAGO TRAMITADOR CONFIRMADO")  
                         <span class="text-danger">Transacción finalizada</span>
                      @elseif($compra->estado_pago=="RECHAZADA")  
                         <span class="text-red">Transacción rechazada</span>
                      @endif
                    </td>        
                    <td>{{$compra->nombre_tramite}}</td>   
                    <td class="bg-success">{{$compra->nombre}}</td>          
                    <td>{{$compra->telefono}}</td>          
                    <td class="bg-warning">{{$compra->email}}</td>   
                    @if($compra->metodo_pago=='BONO REGALO')  
                      <td >$ 0
                        <strong class="text-red">Promoción</strong>
                      </td>

                    @else
                      <td> @if($compra->valor_tramite!=$compra->transation_value)
                            <span class="text-red">$</span><span class="text-primary">{{number_format($compra->transation_value,0,',','.')}}</span> 
                            <strong class="text-red">Promoción</strong>
                           @else
                            <span class="text-red">$</span><span class="text-primary">
                            {{number_format($compra->transation_value,0,',','.')}}
                            </span>
                           @endif
                        </td>
                    @endif  
                    <td class="bg-danger"><span class="text-red">$</span><span class="text-primary">{{number_format($compra->valor_tramite,0,',','.')}}</span></td>
                    <td><strong>{{$compra->transactionId}}</strong></td>
                    <td class="bg-success">{{$compra->updated_at}}</td>
                    <td>
                      @if($compra->estado_pago=="APROBADA")
                        <button id="{{'btn_cal_'.$compra->id_pago}}" type="button" class="btn btn-primary btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_notificar_tramitador'.$compra->id_pago}}','{{$compra->id_pago}}','0',false)" >
                            Notificar al tramitador
                        </button>
                        @if($compra->calificacion==null)

                          <button id="{{'btn_cal_'.$compra->id_pago}}" type="button" class="btn btn-success btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'infocalificar'.$compra->id_pago}}','{{$compra->id_pago}}','0',false)" >
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
                    stateSave: true,
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




