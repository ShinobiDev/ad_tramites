@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrate</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre completo</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input max="30" id="email" type="email" class="form-control" name="email" value="{{ $_GET['e'] or old('email') }}"  required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Teléfono</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" minlength="7" maxlength="13" required autofocus>

                                @if ($errors->has('telefono'))
                                    <span class="help-block">
                                        <strong class="text-red" >{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Código referido (opcional)</label>

                            <div class="col-md-6">
                                <input id="codigo_referido" type="text" class="form-control" name="codigo_referido" onchange="validar_codigo(this)" value="{{ old('codigo_referido') }}" max="15">

                                @if ($errors->has('codigo_referido'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('codigo_referido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                            <span class="text-red">
                                <p>
                                  Las credenciales de acceso serán  enviadas al correo
                                </p>
                                <p id="p_error_cod" style="display: none">Este código no es valido</p>
                            </span>
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button id="btn_register" type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    function validar_codigo(e){
        var p_error_cod=document.getElementById("p_error_cod");
            console.log(e);
            console.log(e.value);
            if(e.value!=""){
              peticion_ajax("POST","validar_codigo",{datos:e.value},function(rs){
                    if(rs.respuesta){
                          p_error_cod.style.display='none';
                    }else{
                          p_error_cod.style.display='block';
                    }
              });
            }
    }
</script>
