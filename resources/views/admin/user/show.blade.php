@extends('layouts.app')


@section('content')

<div class="row">
        <!--DIVISION USUARIO-->
        <div class="col-md-4">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle"  src="{{asset('img/logo310x310.png')}}" alt="{{$user->name}}" style="background-color: #3097d1; border-radius:100%" >

            <h3 class="profile-username text-center">{{$user->nombre}}</h3>

            <h3 class="text-muted text-center bg-info">{{$user->getRoleNames()->implode(', ')}}</h3>

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item" style="margin-left:  20px;">
                <b>Email</b> <a class="pull-right" style="margin-right:  20px;">{{$user->email}}</a>
              </li>
              <li class="list-group-item" style="margin-left:  20px;">
                <b>Teléfono</b> <a class="pull-right" style="margin-right: 20px;">{{$user->telefono}}</a>
              </li>
              <li class="list-group-item" style="margin-left:  20px;">
                <b>Código para referir</b> <a class="pull-right" style="margin-right:  20px;">{{$user->codigo_referido}}</a>
              </li>
              @role('Anunciante')
                <li class="list-group-item" style="margin-left:  20px;">
                  <b>Cuenta bancaria</b> <a class="pull-right" style="margin-right:  20px;">{{$user->cuenta_bancaria or 'No registrada'}}</a>
                </li>
                <li class="list-group-item" style="margin-left:  20px;">
                  <b>Certificación bancaria</b> 
                      @if($user->certificacion_bancaria != "")
                        <a class="pull-right" style="margin-right:  20px;" href="{{config('app.url').$user->certificacion_bancaria  }}" target="_blank">Ver</a>
                      @else
                        <a class="pull-right" style="margin-right:  20px;" href="#">Sin registrar</a>
                      @endif
                </li>
                <li class="list-group-item list-group-item-primary" style="text-align: center;">
                  <h3 >Horarios de atención</h3>
                </li>
                @foreach($horarios as $h)
                  <li class="list-group-item" style="margin-left:  20px;"><b >{{$h->dia}} </b> <a style=" margin-right: 20px;" class="pull-right">{{explode("|",$h->horario)[0] }} a {{explode("|",$h->horario)[1] }} {{$h->estado}}</a></li>
                @endforeach
              @endrole  
              {{--se repite horarios--}}
              @role('Admin')
                <li class="list-group-item list-group-item-primary" style="text-align: center;">
                  <h3>Horarios de atención</h3>
                </li>
                @foreach($horarios as $h)
                  <li class="list-group-item" style="margin-left:  20px;"><b >{{$h->dia}} </b> <a style=" margin-right: 20px;" class="pull-right">{{explode("|",$h->horario)[0] }} a {{explode("|",$h->horario)[1] }} {{$h->estado}}</a></li>
                @endforeach
              @endrole  



            </ul>

            <a href="{{route('users.edit', $user)}}" class="btn btn-primary btn-block"><b>Editar</b></a>
          </div>
        </div>
        <!--DIVISION BONIFICACIONES Y CALIFICACIONES-->
        <div class="col-md-3">
            <div class="box box-primary">
                <!--DIVISION MIS BONIFICACIONES-->
                <div class="box-header with-border bg-success">
                  <h3 class="box-title">Mis bonificaciones</h3>
              </div>
              <div class="box-body"><h4 class="box-title"></h4>
                  <a class="btn btn-success" href="{{route('mis_bonificaciones')}}">VER</a>
              </div>
            </div>
            
          <!--DIVISION COMPARTIR EMAIL-->
           <div class="box box-primary ">
              <div class="box-header with-border bg-info">
                  <h3 class="box-title ">Compartir por correo electrónico</h3>
              </div>
              <div class="box-body">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLongShareMail">
                      Compartir
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLongShareMail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="exampleModalLongTitle">Sugiere {{config('app.name')}} a tus amigos y gana bonificaciones.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="{{url('admin/compartir_mail')}}">
                                  {{ csrf_field() }}
                                    <input id="txt_mis_correos" name="correos"  type="text" class="form-control" required>
                                    <h5>Escribe los correos separados por una coma ',' de tus amigos a los que quieres sugerir {{config('app.name')}}. </h5>
                                    <input type="submit" class="btn btn-primary" value="Enviar correo">

                             </form>


                        </div>
                      </div>
                      </div>
                    </div>
              </div>

          </div>
           <!--DIVISION COMPARTIR CON FB-->

           <div class="box box-primary">
              <div class="box-header with-border bg-danger">
                  <h3 class="box-title">Compartir en facebook</h3>
              </div>
              <div class="box-body">
                @include('partials.btn_facebook')
              </div>
          </div>
        </div>
        @role('Admin')
          <!--DIVISION PARA PORCENTAJE-->
          <div class="col-md-3">
              <div class="box box-primary">
                  <div class="box-header with-border bg-warning">
                    <h3 class="box-title">Editar porcentaje ganacia </h3>
                </div>
                <div class="box-body">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalLongEditar">
                        Editar
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModalLongEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-warning">
                              <h5 class="modal-title" id="exampleModalLongTitle">Editar variable de ganancia porcentaje</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="{{url('admin/editar_variables')}}">
                                    {{ csrf_field() }}
                                      <input name="valor" value="{{$variables[0]->valor}}"  type="text" class="form-control" required>
                                      <input name="nombre" value="{{$variables[0]->nombre}}"  type="hidden" >
                                      <h5>Escriba aqui el valor que quieres asignar a tu porcentaje de ganancia por transacción</h5>
                                      <input type="submit" class="btn btn-primary" value="Editar  ">

                               </form>


                          </div>
                        </div>
                        </div>
                      </div>
                </div>

              </div>
            </div>
        @endrole


        
        <!--DIVISION RECARGAS-->
        <div class="col-md-3">
          @role('Anunciante')
            <div class="box box-primary">
                
                  <div class="box-header with-border bg-danger">
                        <h3 class="box-title">Realizar Recarga</h3>
                  </div>
                  <div class="box-body">
                      @if ($recargas->valor_recarga <= '0')
                          <h4 class="text-red">Actualmente No tienes saldo</h4>
                      @else
                        <h4 class="text-success">Su saldo actual es: <span class="text-red">
                          $
                        </span> <span class="text-primary" id="sp_valor_recarga">{{number_format($recargas->valor_recarga,0,',','.')}}</span> <small class="text-red"> {{$recargas->status_recarga}}</small></h4>
                      @endif
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong">
                        Recargar
                      </button>
                      <!-- Modal recargas -->
                      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-danger text-center">
                              <h3 class="modal-title" id="exampleModalLongTitle">Realizar Recargas</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                              @include('payu.recargas_payu')
                              
                          </div>
                        </div>
                        </div>
                      </div>
                  </div>
            </div>
        @endrole      
        </div>
        <!--DIVISION ANUCIOS VISTOS POR MI-->
        <div class="col-md-3">
          <div class="box box-primary">
              <div class="box-header with-border bg-success">
                  <h3 class="box-title">Anuncios vistos</h3>
              </div>
              <div class="box-body"><h4 class="box-title"></h4>
                        <a class="btn btn-success" href="{{route('anuncios_vistos')}}">VER</a>
              </div>
          </div>
        </div>
        @role('Admin')

       @endrole
        <!--DIVISION MIS TRANSACCIONES-->
        <!--
        <div class="col-md-3">

          <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Mis transacciones</h3>
              </div>
              <div class="box-body">


              </div>
          </div>
        </div>-->


</div>


@endsection


