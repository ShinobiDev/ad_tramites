@extends('layouts.app')
@section('content')
{{--dd($user)--}}
    <div class="row">

      <div class="col-md-6">

          <div class="box box-primary">

              <div class="box-header with-border">
                    <h3><i class="fa fa-users"></i>  Datos Personales</h3>
              </div>

              <div class="box-body">

                  <form method="POST" action="{{route('users.update', $user)}}">

                    {{csrf_field()}} {{method_field('PUT')}}

                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" name="nombre" value="{{old('name',$user->nombre)}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" value="{{old('email', $user->email)}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="phone">Teléfono:</label>
                                <input type="text" name="telefono" value="{{old('telefono', $user->telefono)}}" class="form-control" minlength=6 maxlength=13>
                            </div>
                            <div class="form-group">
                                <label for="phone">Cuenta bancaria:</label>
                                
                                <input type="text" name="cuenta_bancaria" value="{{ $user->cuenta_bancaria or ''}}" class="form-control" minlength=6 maxlength=13>
                            </div>
                            <div class="form-group">
                                <label for="phone">Certificación bancaria (solo es valido en formato .pdf):</label>
                                
                                {{--dd($user->certificacion_bancaria)--}}
                                @if($user->certificacion_bancaria != null)
                                  <a href="{{config('app.url').$user->certificacion_bancaria}}" target="_blank" >Ver</a>
                                @endif
                                <input type="file" id="flCertificacionBancaria" name="bancaria" onchange="subir_archivo(this)">     
                                <label id="msnEspera"></label>                             
                            </div>
                            @if($user->estado=="1")
                                <div class="form-group">
                                <span class="help-block">Dejar en blanco si no

                                  quiere cambiar la contraseña</span>
                                  <label for="password">Contraseña</label>
                                  <input type="password" name="password"  class="form-control" placeholder="Nueva Contraseña">

                              </div>

                              <div class="form-group">
                                  <label for="password_confirmation">Confirmar la Contraseña</label>
                                  <input type="password" name="password_confirmation"  class="form-control" placeholder="Confirmar contraseña">
                              </div>
                                 <button class="btn btn-primary btn-block"> <i class="fa fa-refresh"></i> Actualizar Usuario</button>

                            @else
                              <h1 class="text-red">Este usuario esta deshabilitado</h1>
                            @endif
                            
                         

                  </form>
              </div>

          </div>
      </div>

      <div class="col-md-6">
          <!--HORARIOS-->
          @role('Anunciante')
            <div class="box box-primary">
              <div class="box-header with-border">
                    <div class="box-title ">
                        <h3> <i class="fa fa-lock"></i> Horarios</h3>
                    </div>
              </div>
              <div class="box-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    
                  </thead>
                  <tbody>

                      @foreach($horarios as $h)
                          <tr>      
                              <td>{{$h->dia}}:</td> 
                              <td> Desde las   
                                  <input id="inp_{{$h->id}}_am" type="time" value="{{explode('|',$h->horario)[0] }}" onchange="cambiar_horario('{{$h->id}}')" /> 
                              </td>
                              <td> hasta las 
                                <input id="inp_{{$h->id}}_pm" onchange="cambiar_horario('{{$h->id}}')" type="time" value="{{explode('|',$h->horario)[1] }}"  />
                              </td>
                              <td> 

                                @if($h->estado=="Abierto")
                                  <span id="dia_estado_{{$h->id}}">Abierto</span> <input  id="inp_estado_dia_{{$h->id}}" type="checkbox" value="abierto" onchange="cambiar_estado_dia('{{$h->id}}')" checked>
                                @else
                                  <span id="dia_estado_{{$h->id}}">Cerrado</span> <input  id="inp_estado_dia_{{$h->id}}" type="checkbox" value="cerrado" onchange="cambiar_estado_dia('{{$h->id}}')" />
                                @endif
                              
                              </td>
                              
                           </tr>
                           <span id="mens"></span>     
                      @endforeach
                  </tbody>
                </table>  
              </div>

            </div>
          @endrole
          <!--HORARIOS se repite-->
          @role('Admin')
            <div class="box box-primary">
              <div class="box-header with-border">
                    <div class="box-title ">
                        <h3> <i class="fa fa-lock"></i> Horarios</h3>
                    </div>
              </div>
              <div class="box-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    
                  </thead>
                  <tbody>

                      @foreach($horarios as $h)
                          <tr>      
                              <td>{{$h->dia}}:</td> 
                              <td> Desde las   
                                  <input id="inp_{{$h->id}}_am" type="time" value="{{explode('|',$h->horario)[0] }}" onchange="cambiar_horario('{{$h->id}}')" /> 
                              </td>
                              <td> hasta las 
                                <input id="inp_{{$h->id}}_pm" onchange="cambiar_horario('{{$h->id}}')" type="time" value="{{explode('|',$h->horario)[1] }}"  />
                              </td>
                              <td> 

                                @if($h->estado=="Abierto")
                                  <span id="dia_estado_{{$h->id}}">Abierto</span> <input  id="inp_estado_dia_{{$h->id}}" type="checkbox" value="abierto" onchange="cambiar_estado_dia('{{$h->id}}')" checked>
                                @else
                                  <span id="dia_estado_{{$h->id}}">Cerrado</span> <input  id="inp_estado_dia_{{$h->id}}" type="checkbox" value="cerrado" onchange="cambiar_estado_dia('{{$h->id}}')" />
                                @endif
                              
                              </td>
                              
                           </tr>
                           <span id="mens"></span>     
                      @endforeach
                  </tbody>
                </table>  
              </div>

            </div>
          @endrole
           <!--ROLES--> 
          <div class="box box-primary">
            <div class="box-header with-border">
                  <div class="box-title ">
                      <h3> <i class="fa fa-lock"></i> Roles</h3>
                  </div>
            </div>
            <div class="box-body">

              @role('Admin')
              <form method="POST" action="{{route('users.roles.update', $user)}}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                @include('admin.roles.option')

                <button  class="btn btn-primary btn-block"name="button"> <i class="fa fa-refresh"></i>Actualizar Roles</button>
              </form>
            @else
              <ul class="list-group">
                  @forelse ($user->roles as $role)
                      <li class="list-group-item">{{$role->name}}</li>
                    @empty
                      <li class="list-group-item">No tiene Roles</li>
                  @endforelse
              </ul>
              @endrole
            </div>

          </div>
           <!--PERMISOS--> 
          <div class="box box-primary">
              <div class="box-header with-border">
                    <div class="box-title ">
                        <h3> <i class="fa fa-unlock-alt"></i> Permisos</h3>
                    </div>
              </div>
              <div class="box-body">

              @role('Admin')
                <form method="POST" action="{{route('users.permissions.update', $user)}}">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                @include('admin.permissions.option',['model' => $user])

                  <button  class="btn btn-primary btn-block"name="button"> <i class="fa fa-refresh"></i>Actualizar Permisos</button>
                </form>
              @else
                <ul class="list-group">
                  
                    @forelse ($user->getPermissionsViaRoles() as $permission)

                      <li class="list-group-item">{{$permission->name}}</li>

                    @empty
                      <li class="list-group-item">No tiene permisos</li>
                    @endforelse
                </ul>
                @endrole
              </div>

            </div>
      </div>
    </div>
    <script type="text/javascript">
      function cambiar_horario(id){
        var horario=document.getElementById("inp_"+id+"_am").value+"|"+document.getElementById("inp_"+id+"_pm").value;
        mostrar_cargando("mens",100,"Cragando")
        peticion_ajax("get","admin/cambiar_horario/"+id+"/"+horario,{},function(rs){
          console.log(rs);
          document.getElementById("mens").innerHTML="horario cambiado";
        });
      }
      function cambiar_estado_dia(id){
          mostrar_cargando("mens",100,"Cragando")
          peticion_ajax("get","admin/cambiar_estado_dia/"+id+"/"+document.getElementById('inp_estado_dia_'+id).checked,{},function(rs){
            console.log(rs);
            document.getElementById("mens").innerHTML="estado del dia cambiado ha "+rs.estado;
            document.getElementById("dia_estado_"+id).innerHTML=rs.estado;
          });
      }

      function subir_archivo(e){
        //e.preventDefault();
          mostrar_cargando("msnEspera",10,"Cargando ...");
          var Token =  '{{csrf_token()}}';
          var formData = new FormData();
          formData.append("file", $('#'+e.id).get(0).files[0]);
          formData.append("Token", Token);

          // Send the token every ajax request
          $.ajaxSetup({
              headers: { 'X-CSRF-Token' : Token }
          });

              $.ajax({        
                      url: "{{config('app.url')}}"+"/admin/actualizar_certificacion_bancaria/{{$user->id}}",
                      method: 'POST',
                      data: formData,
                      processData: false,
                      contentType: false,
                      cache: false,
                      success: function(data) {
                          document.getElementById("msnEspera").innerHTML=data.mensaje;
                      },
                      error:function(data){
                        console.log(data);
                        if(data.responseJSON.message=="The given data was invalid."){
                          document.getElementById("msnEspera").innerHTML="El formato del archivo debe ser .pdf";  
                        }else{
                          document.getElementById("msnEspera").innerHTML=data.responseJSON.message;
                        }
                        
                      }
              });
      }
    </script>

  



@endsection
