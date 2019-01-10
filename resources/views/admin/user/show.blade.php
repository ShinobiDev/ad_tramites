@extends('layouts.app')


@section('content')

<div class="row">
        <!--DIVISION USUARIO-->
        <div class="col-md-4">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle"  src="{{asset('img/logo310x310.png')}}" alt="{{$user->name}}" style="background-color: #3097d1; border-radius:100%" >

            <h3 class="profile-username text-center">{{$user->nombre}}</h3>

            <p class="text-muted text-center">{{$user->getRoleNames()->implode(', ')}}</p>

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item" style="margin-left:  20px;">
                <b>Email</b> <a class="pull-right" style="margin-right:  20px;">{{$user->email}}</a>
              </li>
              <li class="list-group-item" style="margin-left:  20px;">
                <b>Teléfono</b> <a class="pull-right" style="margin-right: 20px;">{{$user->telefono}}</a>
              </li>
              <li class="list-group-item" style="margin-left:  20px;">
                <b>Código referido</b> <a class="pull-right" style="margin-right:  20px;">{{$user->codigo_referido}}</a>
              </li>
              <li class="list-group-item" style="text-align: center;">
                <b>Horarios de atención</b>
              </li>
              @foreach($horarios as $h)
                <li class="list-group-item" style="margin-left:  20px;"><b >{{$h->dia}} </b> <a style=" margin-right: 20px;" class="pull-right">{{explode("|",$h->horario)[0] }} a {{explode("|",$h->horario)[1] }} {{$h->estado}}</a></li>
              @endforeach



            </ul>

            <a href="{{route('users.edit', $user)}}" class="btn btn-primary btn-block"><b>Editar</b></a>
          </div>
        </div>
        <!--DIVISION RECARGAS Y CALIFICACIONES-->
        <div class="col-md-3">
          <!--DIVISION RECARAGS-->
          <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Realizar Recarga</h3>
              </div>
              <div class="box-body">



                      @if ($recargas->valor_recarga <= '0')
                          <h4>Actualmente No tienes saldo</h4>
                      @else
                        <h4>Su saldo actual es: $ {{number_format($recargas->valor_recarga,0,',','.')}} <small> {{$recargas->status_recarga}}</small></h4>
                      @endif




                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                      Recargar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Realizar Recargas</h5>
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
          <!--DIVISION COMPARTIR EMAIL-->
           <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Compartir por correo electrónico</h3>
              </div>
              <div class="box-body">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLongShareMail">
                      Compartir
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLongShareMail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Comparte tu código de referido</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="{{url('admin/compartir_mail')}}">
                                  {{ csrf_field() }}
                                    <input id="txt_mis_correos" name="correos"  type="text" class="form-control" required>
                                    <h5>Escriba separado de ',' cada uno de los correos con los que quiere compartir su código de referido.</h5>
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
              <div class="box-header with-border">
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
                  <div class="box-header with-border">
                    <h3 class="box-title">Editar porcentaje ganacia </h3>
                </div>
                <div class="box-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLongEditar">
                        Editar
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModalLongEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
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


        <!--DIVISION MIS BONIFICACIONES-->

        <div class="col-md-3">
         <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Mis bonificaciones</h3>
              </div>
              <div class="box-body"><h4 class="box-title"></h4>

                        <a class="btn btn-primary" href="{{route('mis_bonificaciones')}}">VER</a>
              </div>

          </div>
        </div>
        <!--DIVISION ANUCIOS VISTOS POR MI-->
        <div class="col-md-3">
          <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Anuncios vistos</h3>
              </div>
              <div class="box-body"><h4 class="box-title"></h4>
                        <a class="btn btn-primary" href="{{route('anuncios_vistos')}}">VER</a>

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
@include('partials.scripts')

