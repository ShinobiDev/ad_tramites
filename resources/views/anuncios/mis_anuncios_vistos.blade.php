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
                @include('anuncios.filtro_tramites_anuncios_vistos')
             </div>
             <div class="box-body col-sm-10">
                      @include('partials.alert')
                      @include('anuncios.tabla_anuncios_vistos')
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
