@extends('layouts.app')

@section('head')
  {{-- content --}}
@endsection


@section('content')

      <body class="server-prod session-anonymous">
        <div class="container">
          <h1 class="text-center">Crea una campaña en <strong class="text-primary">{{config('app.name')}}</strong></h1>



            <div class="row container">
              <div id="identification_hint" class="col-md-12 display-none">
                <h2 class="text-center text-red">Normas y requisitos para crear una campaña</h2>

                  <noscript>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="alert alert-danger">
                                  Debe activar JavaScript para poder completar este formulario.
                              </div>
                          </div>
                      </div>
                  </noscript>

                <ul>
                  <li>Ingresa el nombre de la campaña, este debe ser claro y acorde a la campaña propuesta</li>
                  <li>Selecciona la fecha de vigencia, si la dejas en blanco, esta estara vigente hasta que se acaben los cupones</li>
                  <li>Selecciona la cantidad de cupones que quieres crear</li>
                  <li>Ingresa el usuario autorizado para la campaña, en caso de ser una campaña, sin ningun usuario preferencial, este campo debera estar en blanco</li>            
                </ul>                    
              </div>
            </div>

            <legend class="text-center">Crea una campaña</legend>
            <div class="row " id="">
                <div id="" class="col-md-2 label-col form-group">
                  <!--<label for= "" class="control-label requiredField">Deseo...</label>-->
                </div>

           </div>
           <div class="row">
              <form class="col-12 col-md-12" method="POST" action="{{route('campanias.store')}}">
                  {{csrf_field()}}
                  <div class="form-group col-6 col-md-6">
                    <label for="exampleInputEmail1">Nombre campaña</label>
                    <input type="text" name="nombre_campania" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa el nombre de la campaña" value="{{old('nombre_campania')}}" required>
                    
                  </div>
                  <div class="form-group col-6 col-md-6">
                    <label for="exampleInputPassword1">Tipo de campaña</label>
                   
                   <select class="form-control select2" name="tipo_canje" value="{{old('tipo_canje')}}">
                        <option value="compra">Compras en {{config('app.name')}}</option>
                        <option value="recarga">Recargas en {{config('app.name')}}</option>
                    </select>
                  </div>
                  <div class="form-group col-6 col-md-6">
                    <label for="exampleInputPassword1">Selecciona para quien aplica la campaña</label>
                   
                   <select class="form-control select2" name="tipo_campania" value="{{old('tipo_campania')}}" onchange="cambiarselect(this);">
                        <option value="clientes">Clientes</option>
                        <option value="tramitadores">Tramitadores</option>
                    </select>
                  </div>
                  <div class="form-group col-6 col-md-6">
                   <label for="exampleInputPassword1">Usuario autorizado para canjear</label>
                   
                   <select id="sel_usuario_tramitador" class="form-control select2" style="display: none" name="usuario_tramitador" value="{{old('usuario_tramitador')}}">
                        <option value="0">No selecciones ningún usuario si es una campaña abierta a todos los usuarios</option>
                      @foreach($users_tramitadores as $u)
                        <option value="{{$u->id}}">{{$u->nombre}}</option>
                      @endforeach  
                    </select>

                    <select id="sel_usuario_cliente" class="form-control select2"  name="usuario_cliente" value="{{old('usuario')}}">
                        <option value="0">No selecciones ningún usuario si es una campaña abierta a todos los usuarios</option>
                      @foreach($users_clientes as $u)
                        <option value="{{$u->id}}">{{$u->nombre}}</option>
                      @endforeach  
                    </select>
                  </div>
                  
                  <div class="form-group col-6 col-md-6">
                    <label for="exampleInputPassword1">Fecha inicio de la campaña  </label>
                    <input type="date" name="fecha_inicial_vigencia" class="form-control" id="exampleInputPassword1" value="{{old('fecha_vigencia')}}" >
                  </div>
                  <div class="form-group col-6 col-md-6">
                    <label for="exampleInputPassword1">Fecha límite vigencia de la campaña  </label>
                    <input type="date" name="fecha_final_vigencia" class="form-control" id="exampleInputPassword1" value="{{old('fecha_vigencia')}}" >
                  </div>
                   <div class="form-group col-6 col-md-6">
                    <label for="exampleInputPassword1">Número de cupones</label>
                    <input type="number" name="numero_cupones" class="form-control" id="exampleInputPassword1" value="{{old('nombre_campania') or 1}}" min="1" required>
                  </div>
                   <div class="form-group col-6 col-md-6">
                    <label for="exampleInputPassword1">Valor de descuento</label>
                    <input type="number" name="valor_descuento" class="form-control" id="exampleInputPassword1" placeholder="Solo debes ingresar el valor" value="{{old('valor_descuento')}}" min="1" required>
                  </div>
                  <div class="form-group col-6 col-md-6">
                    <label for="exampleInputPassword1">Ingresa código de cupon</label>
                    <input type="text" name="codigo_cupon" class="form-control" id="exampleInputPassword1" placeholder="Si deseas que se genere automáticamente, por favor deja este campo en blanco" value="{{old('codigo_cupon')}}" >
                  </div>
                 
                  <div class="form-group col-12 col-md-12">
                    <button type="submit" class="btn btn-success">Crear campaña</button>                 
                  </div>
                  
                </form>
                
           </div>

            <footer>
            </footer>
          </div>

      </body>
@endsection

@include('partials.scripts')

@section('scripts')
  <script type="text/javascript">
    function cambiarselect(e){
     switch(e.value){
        case "tramitadores":
          document.getElementById('sel_usuario_tramitador').style.display='';
          document.getElementById('sel_usuario_cliente').style.display='none';
        break;
        case "clientes":
          document.getElementById('sel_usuario_cliente').style.display='';
          document.getElementById('sel_usuario_tramitador').style.display='none';
        break;
      }      
    }
  </script>
@endsection
