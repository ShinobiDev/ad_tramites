@extends('layouts.app')
@section('head')

@endsection
@section('header')
    <h1>
        Anuncios vistos por mi
    </h1>
    <small>Listado</small>

    <ol class="breadcrumb">
      <li><a href="{{route('welcome')}}"><i class="fa fa-dashboard">Inicio</i></a></li>
      <li class="active"></li>
    </0l>

@endsection

@section('content')

  <div class="container-fluid">
      <div class="col-md-12 col-lg-offset-0">
        <div class="box box-primary">
          <div class="box-header">
              <h3 class="box-title">Listado de anuncios vistos por mi</h3>
          </div>
          <div class="row"> 
             <div class="box-body col-sm-2">
                @include('anuncios.filtro_tramites')
             </div>
             <div class="box-body col-sm-10">
                      <table id="vistos-table" class="table table-striped table-codensed table-hover table-resposive">
                            <thead>
                              <tr>
                                <th>Tramite</th>
                                <th>Descripción</th>
                                <th>Ciudad</th>
                                <th>Valor</th>
                                <th>Nombre usuario</th>
                                <th>Acciones</th>
                              </tr>
                            </thead>
                           
                            <tbody id="tbbody">
                              {{--se crean las tablas de ventas--}} 
                              @foreach ($anuncios as $ad)
                                  
                                   <tr>
                                    <td class="text-green text-center"><strong><h3>{{$ad->nombre_tramite}}</h3></strong></td>
                                    <td class=" text-center"><strong><h5>{{$ad->descripcion}}</h5></strong></td>
                                    <td class=" text-center"><strong><h5>{{$ad->ciudad}}</h5></strong></td>
                                    <td class=" text-center"><strong><h5>$ {{number_format($ad->valor_tramite,2,',','.')}}</h5></strong></td>
                                    <td>
                                     <strong><h5>{{$ad->nombre}}</h5></strong>
                                    </td>
                                   <td>
                                      @guest
                                             <!--AQUI SE MUESTRA LOS BOTONES PARA LOGIN -->

                                              <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-success" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_login'.$ad->id}}','{{$ad->id}}','0','info')">
                                                Ver info
                                                </button>
                                                                      
                                              <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-default" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_login'.$ad->id}}','{{$ad->id}}','0','venta')">
                                                Comprar
                                              </button>
                                             
                                          
                                          @include('anuncios.ventana_modal_login')  
                                      @else
                                            @if($ad->btn_info) 
                                            
                                                <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-success" data-toggle="modal" onclick="descontar_recargar('{{ 'infogen'.$ad->id}}','{{$ad->id}}','0','info')">
                                                Ver info
                                                </button>
                                                                   
                                                @include('anuncios.ventana_modal_info_general')
                                              
                                            @endif                                

                                            @if($ad->btn_payu)  
                                              <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-default" data-toggle="modal" onclick="descontar_recargar('{{ 'infoventa'.$ad->id}}','{{$ad->id}}','0','compra')" >
                                                Comprar
                                              </button>
                                            
                                             @include('anuncios.ventana_modal_info_anuncio')
                                            @endif

                                            @if($ad->btn_calificar)
                                               <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-primary" data-toggle="modal" onclick="descontar_recargar('{{ 'infocalificar'.$ad->id}}','{{$ad->id}}','0','compra')" >
                                                Calificar
                                              </button>
                                               @include('partials.btn_calificar_anunciante')
                                            @endif  

                                      @endguest
                                    </td>
                                   </tr>
                              @endforeach
                              {{--/se crean las tablas de ventas--}} 
                            </tbody>
                      </table>
             </div>
          </div>
            
     
        </div>
    </div>
  </div>


@endsection



@section('scripts')
    
          <script type="text/javascript">
           
                  $(function (){
                      $('#users-table').DataTable({
                        responsive: true,
                        'language':
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
                      });
                  });
            
  
             </script>
@endsection


@include('partials.scripts')
