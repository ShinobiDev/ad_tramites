@extends('layouts.app')
@section('head')

@endsection
@section('header')
    <h1>
        Todas las transacciones
    </h1>
    <small>Listado</small>

    <ol class="breadcrumb">
      <li><a href="{{route('welcome')}}"><i class="fa fa-dashboard">  Inicio</i></a></li>
      <li class="active">Ingresos</li>
    </ol>

@endsection

@section('content')

  <div class="container-fluid">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Listado de transacciones realizadas</h3>
      </div>
      <div class="box-body">
          <table id="transacciones-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                
                <th>Trámite</th>
                <th>Estado transacción</th>
                <th>Vendedor</th>
                <th>Teléfono tramitador</th>
                <th>E-mail tramitador</th>
                <th>Cuenta bancaria tramitador</th>
                
                <th>Valor transacción</th>
                <th>% tu tramitador</th>
                <th>Valor a pagar al tramitador</th>
                <th>Referecia de pago</th>
                <th>Fecha transacción</th>
                
                <th>Acción</th>  
              </tr>
            </thead>
            <tbody>
              
              @foreach ($transacciones as $transaccion)
                  <tr id="row_{{$transaccion->id_pago}}">      
                     
                    <td>{{$transaccion->nombre_tramite}}</td> 
                     <td>
                      @if($transaccion->estado_pago=="PENDIENTE")
                        <span class="text-warning">Pendiente por pago del cliente</span>
                      @elseif($transaccion->estado_pago=="APROBADA")
                        <span class="text-primary">Pago del cliente aceptado</span>
                      @elseif($transaccion->estado_pago=="TRAMITE REALIZADO")  
                        <span class="text-info">Trámite realizado</span>
                      @elseif($transaccion->estado_pago=="TRANSACCION FINALIZADA")  
                         <span class="text-danger">Pendiente de pago al tramitador</span>
                      @elseif($transaccion->estado_pago=="PAGO A TRAMITADOR")  
                        <span class="text-dark">Pago enviado a tramitador</span>
                      @elseif($transaccion->estado_pago=='PAGO TRAMITADOR CONFIRMADO')
                        <span class="text-green">Pago hecho al tramitador </span>
                      @elseif($transaccion->estado_pago=="RECHAZADA")  
                        <span class="text-red">Transacción rechazada</span>
                      @endif
                    </td>         
                    <td>{{$transaccion->nombre}}</td>          
                    <td>{{$transaccion->telefono}}</td>          
                    <td>{{$transaccion->email}}</td>          
                    <td>
                        @if($transaccion->cuenta_bancaria!="")
                          <span class="text-green">{{$transaccion->cuenta_bancaria}}</span>
                        @else
                          <span class="text-red">Sin registrar</span>
                        @endif
                    </td>          
                    
                                  
                                                       
                                                      
                    <td>${{number_format($transaccion->valor_tramite,0,',','.')}}</td>

                    @if($transaccion->estado_pago=="PAGO A TRAMITADOR")  
                    
                      <td>{{number_format($transaccion->porcentaje_pago,'0',',','.')}} %</td> 
                      <td width="15%">$ {{number_format($transaccion->valor_tramite-($transaccion->valor_tramite*$transaccion->porcentaje_pago/100),0,',','.')}}</td>
                    
                    @elseif($transaccion->estado_pago=='PAGO TRAMITADOR CONFIRMADO')
                    
                      <td>{{number_format($transaccion->porcentaje_pago,'0',',','.')}} %</td> 
                      <td width="15%">$ {{number_format($transaccion->valor_tramite-($transaccion->valor_tramite*$transaccion->porcentaje_pago/100),0,',','.')}}</td>  
                    
                    @else
                    
                      <td>{{$porcentaje[0]->valor}} %</td> 
                      <td width="15%">${{number_format($transaccion->valor_tramite-($transaccion->valor_tramite*$porcentaje[0]->valor/100),0,',','.')}}</td>

                    @endif

                    

                    


                    <td>{{$transaccion->transactionId}}</td>
                    <td>{{$transaccion->updated_at}}</td>
                   
                    <td>
                          
                      @if($transaccion->estado_pago=="TRANSACCION FINALIZADA")    
                          @if($transaccion->cuenta_bancaria == '' )    
                            <button id="{{'btn_cal_'.$transaccion->id_pago}}" type="button" class="btn btn-primary btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_notificar_tramitador'.$transaccion->id_pago}}','{{$transaccion->id_pago}}','0',false)" >
                            Notificar al tramitador
                        </button>
                        

                          @endif
                          <button id="{{'btn_cal_'.$transaccion->id_pago}}" type="button" class="btn btn-success btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_pago_a_tramitador'.$transaccion->id_pago}}','{{$transaccion->id_pago}}','0',false)" >Confirmar pago a tramitador
                          </button>
                          
                         

                      @elseif($transaccion->estado_pago=="APROBADA") 
                           Pendiente confirmación cliente   
                      @endif
                    </td>                                   
                     
                                                      
                  </tr>
              @endforeach

            </tbody>
          </table>
          <!--VENTANA ENVIO DOCUMENTACION -->
          <!--ventanas modales-->
           @foreach ($transacciones as $transaccion)               
                            
              @if($transaccion->estado_pago=="TRANSACCION FINALIZADA")    
                      @if($transaccion->cuenta_bancaria == '' )    
                           @include('partials.notificar_tramitador',['ad'=>$transaccion])
                      @endif
              @endif
                          
                      @include('partials.confirmar_pago_a_tramitador',['ad'=>$transaccion,'valor'=>number_format($transaccion->valor_tramite-($transaccion->valor_tramite*$porcentaje[0]->valor/100),0,',','.')])

                      
              @endforeach

      </div>
      
        
 
    </div>
  </div>



@endsection

@section('scripts')
          
          <script>
            $(document).ready(function() {
                console.log("5");
                $('#transacciones-table').DataTable( {
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
                filtro_url('#transacciones-table');


            });
          </script>
       
            
@endsection




