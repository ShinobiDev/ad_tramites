<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>{{ config('app.name') }}</title>

    <meta property="og:url"           content="{{config('app.url')}}/register_landing/{{$user->codigo_referido}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{config('app.name')}} " />
    <meta property="og:description"   content="Registrate en {{config('app.name')}}} y podras adquirir u ofrecer trámites de tránsito" />
    <meta property="og:image"         content="{{asset('img/logo.png')}}" />



    <!-- Styles -->
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
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
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
                        <img class="logo" style="height: 38px;margin-bottom: 5px" src="{{asset('img/logo.png')}}">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">

                        <li>
                           <a href="{{route('anuncios.index')}}">Ver anuncios</a>
                        </li>

                    </ul>







                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->


                             
                     
                    </ul>
                </div>
            </div>
        </nav>


       

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
    <script src="{{ asset('js/recargas.js') }}"></script>
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
  
    {{-- <script src="{{asset('admin-lte/plugins/datatables/dataTables.bootstrap4.min.js')}}">  </script> --}}

  
</body>
</html>
