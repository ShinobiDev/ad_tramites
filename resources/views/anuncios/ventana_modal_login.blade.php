     <div class="modal fade" id="{{'ventana_login'.$ad->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-header bg-primary">
              <h5 class="modal-title text-center" id="exampleModalLabel">Ingresa tus datos. Debes estar Registrado. Registrarse es Gratis.</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="salir_modal('{{'ventana_login'.$ad->id}}')">
                <span aria-hidden="true" >&times;</span>
              </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail </label>

                        <div class="col-md-6">
                            <input id="email{{$ad->id}}" type="email" class="form-control" name="email" value="{{ old('email') }}" onchange="agregar_correo(this,'{{$ad->id}}')" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Clave</label>
                        <div class="col-md-6">
                            <input id="password{{$ad->id}}" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                                </label>
                                <button type="submit" class="btn btn-primary">
                                    Ingresar
                                </button>
                            </div>

                        </div>

                    </div>
                </form>
                <!--FORMULARIO PARA ENVIAR EMAIL-->
                <div class="modal-body">
                    <div class="form-group col-md-6 col-md-offset-4">

                            <form method="GET" action="{{route('register')}}">
                                <input type="hidden" name="e" id="email_enviar_{{$ad->id}}" value="{{old('email')}}">
                                <button type="submit" class="btn btn-primary">Registrarse</button>

                                <a id="anOlvide{{$ad->id}}" class="btn btn-link" href="{{ route('password.request').'/?'}}e={{old('email')}}">
                                  Olvide mi clave
                                </a>
                            </form>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="salir_modal('{{'ventana_login'.$ad->id}}')">SALIR</button>
            </div>
          </div>
        </div>
    </div>
    <script type="text/javascript">
        function agregar_correo(e,id){
            document.getElementById('anOlvide'+id).href="{{route('password.request')}}?e="+document.getElementById(e.id).value;        
            document.getElementById('email_enviar_'+id).value=document.getElementById(e.id).value;
        }
    </script>
