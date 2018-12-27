@extends('layouts.app')
        @section('head')

        @endsection

        @section('header')
            <h1>
                Anuncios
            </h1>
            <small>Listado</small>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard">  Inicio</i></a></li>
              <li class="active">Anuncios</li>
            </0l>

        @endsection
        <!--SECCION DE CONSULTA DE ANUNCIOS-->
        

        
        @if($mis_anuncios==true)
            @section('content')
             
              
               
               <!--se incluye seccion de tabla con anuncios de ventas-->
               @include('anuncios.consulta_mis_anuncios')
               <!--FIN se incluye seccion de tabla con anuncios de ventas-->
               

               
            @endsection
        @else
          @section('content')
             
             
             
             <!--se incluye seccion de tabla con anuncios de ventas-->
             @include('anuncios.consulta_anuncios')
             <!--FIN se incluye seccion de tabla con anuncios de ventas-->
             
    
          @endsection
        @endif

        
        

        

        <!--FINSECCION DE CONSULTA DE ANUNCIOS-->
        
              
          
        @section('scripts')

             <script>
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

             <script>
                  $(function (){
                      $('#comprar-table').DataTable({
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
