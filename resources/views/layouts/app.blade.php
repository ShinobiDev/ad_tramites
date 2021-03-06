  <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/datatables/datatables.min.css')}}">
    
  <!-- Styles -->
  <style>
      html, body {
          font-family: arial;
      }

  </style>
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('ico.png')}}">
  <!--datatable responsive-->
   <!--datatable responsive-->
  <!--<link rel="stylesheet" type="text/css" href="{{asset('css/dropzone.css')}}">
  <script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script> -->

    @yield('head')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">

                        <img class="logo" src="{{asset('img/logo.png')}}">
                        {{--<h4 class="box-tittle">{{config('app.name')}}</h4>--}}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">

                       @guest
                        <li>
                           <a href="{{ url('/') }}">Ver anuncios</a>
                           <input type="hidden" value="0" id="user_id">
                        </li>
                        
                      @else
                        <li>
                           <a href="{{ url('/') }}">Ver anuncios</a>
                            <input type="hidden" value="{{auth::user()->id}}" id="user_id">
                        </li>
                        <li>
                           <!--<a href="{{route('anuncios.create')}}">Publicar anuncios</a>-->
                        </li>                       
                        @role('Admin')
                        <li>
                           <a href="{{route('anuncios.show',['id'=>Auth::user()->id])}}">Anuncios</a>
                        </li>
                        <li>
                            <a href="{{route('todas_las_transacciones')}}">Transacciones</a>
                        </li>
                        <li>
                          <a href="{{route('recargas.show')}}">Recargas</a>
                        </li>
                        <li>
                          <a href="{{route('campanias.show')}}">Campañas</a>
                        </li> 

                           
                           
                        @endrole
                        @role('Anunciante')
                          <li>
                             <a href="{{route('anuncios.show',['id'=>Auth::user()->id])}}">Mis anuncios</a>
                          </li>
                          <li>
                            <a href="{{route('mis_ventas', auth()->user())}}">Mis ventas</a>
                          </li>
                          <li>
                            <a href="{{route('mis_compras', auth()->user())}}">Mis compras</a>
                          </li>
                          <li>
                            <a href="{{route('anuncios_vistos')}}">Anuncios vistos</a>
                          </li>
                           <li>
                            <a href="{{route('users.show', auth()->user())}}">Recargar</a>
                          </li>
                        @endrole
                        @role('Usuario')
                          <li>
                            <a href="{{route('mis_compras', auth()->user())}}">Mis compras</a>
                          </li>  
                           <li>
                            <a href="{{route('anuncios_vistos')}}">Anuncios vistos</a>
                          </li>                        
                        @endrole
                     
                      @endguest
                      <li>
                       
                      </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->


                             <li>
                        @guest
                            <li><a href="{{ route('login') }}">Ingresar</a></li>
                            <li><a href="{{ route('register') }}">Registrarse</a></li>
                            <li><a href="/ayuda">Ayuda</a></li>
                        @else

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->nombre }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">


                                      
                                      <li class="dropdown">
                                        @role('Admin') {{-- Laravel-permission blade helper --}}
                                        <a href="{{route('users.index')}}">Usuarios</a>
                                        <a href="{{route('permissions.index')}}">Permisos</a>
                                        <a href="{{route('roles.index')}}">Roles</a>

                                        @endrole
                                        <a href="{{route('users.show', auth()->user())}}">Perfil</a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <strong>Salir</strong>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                      </li>



                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @include('partials.error')
        @include('partials.success')
        @include('partials.alert')
        @yield('content')

    </div>
    <footer class="">
        <div class="container">
          <center style="height:50px;">
              <a href="http://prismaweb.co/diseno-a-la-medida/" target="_blank" >Desarollado por: </a>
              <a href="http://prismaweb.co/diseno-a-la-medida/" target="_blank" ><img src="http://metalbit.co/core/img/PrimaGris.png" alt="WWW.PRISMAWEB.CO - Skype: prismaweb22" /></a>
          <center/>
        </div>
    </footer>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/notas.css')}}">
    <script src="{{ asset('js/app.js') }}"></script>
    

    {{-- <script src="{{asset('admin-lte/plugins/datatables/datatables.min.js')}}">  </script> --}}
    <script src="{{asset('admin-lte/plugins/datatables/jquery.dataTables.min.js')}}">  </script>
    <script src="{{asset('admin-lte/plugins/datatables/dataTables.buttons.min.js')}}">  </script>
    <script src="{{asset('admin-lte/plugins/datatables/buttons.flash.min.js')}}">  </script>
    <script src="{{asset('admin-lte/plugins/datatables/jszip.min.js')}}">  </script>
    <script src="{{asset('admin-lte/plugins/datatables/pdfmake.min.js')}}">  </script>
    <script src="{{asset('admin-lte/plugins/datatables/vfs_fonts.js')}}">  </script>
    <script src="{{asset('admin-lte/plugins/datatables/buttons.html5.min.js')}}">  </script>
    <script src="{{asset('admin-lte/plugins/datatables/buttons.print.min.js')}}">  </script>
    <script src="{{asset('admin-lte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <!--datatable responsive -->
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <!--datatable responsive -->


    {{-- <script src="{{asset('admin-lte/plugins/datatables/dataTables.bootstrap4.min.js')}}">  </script> --}}

    @include('partials.scripts')
    <script src="{{ asset('js/recargas.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">

    <!--seect 2-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
       
    @yield('scripts')
    <script type="text/javascript">
      $(document).ready(function() {
      $('.select2').select2();
    });
    </script>
</body>
</html>
