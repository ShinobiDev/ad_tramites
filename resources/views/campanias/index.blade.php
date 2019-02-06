@extends('layouts.app')

@section('head')
  {{-- content --}}
@endsection


@section('content')

      <body class="server-prod session-anonymous">
        <div class="container">
          <h1 class="text-center">Crea una campaña en <strong>{{config('app.name')}}</strong></h1>



            <div class="row container">
              <div id="identification_hint" class="col-md-12 display-none">
                <h2 class="text-center">Normas y requisitos para crear una campaña</h2>

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
                    <label for="exampleInputPassword1">Usuario autorizado para canjear</label>
                   
                   <select class="form-control select2" name="usuario" value="{{old('usuario')}}">
                        <option value="0">No selecciones ningún usuario si es una campaña abierta a todos los usuarios</option>
                      @foreach($users as $u)
                        <option value="{{$u->id}}">{{$u->nombre}}</option>
                      @endforeach  
                    </select>
                  </div>
                  <div class="form-group col-6 col-md-6">
                    <label for="exampleInputPassword1">Fecha límite vigencia  </label>
                    <input type="date" name="fecha_vigencia" class="form-control" id="exampleInputPassword1" value="{{old('fecha_vigencia')}}" >
                  </div>
                   <div class="form-group col-6 col-md-6">
                    <label for="exampleInputPassword1">Número de cupones</label>
                    <input type="number" name="numero_cupones" class="form-control" id="exampleInputPassword1" value="{{old('nombre_campania') or 1}}" min="1" required>
                  </div>
                   <div class="form-group col-12 col-md-12">
                    <label for="exampleInputPassword1">Valor de descuento</label>
                    <input type="number" name="valor_descuento" class="form-control" id="exampleInputPassword1" placeholder="Solo debes ingresar el valor" value="{{old('valor_descuento')}}" min="1" required>
                  </div>
                 
                  <div class="form-group col-12 col-md-12">
                  <button type="submit" class="btn btn-primary">Crear campaña</button>                 
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

@endsection
