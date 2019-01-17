 <div class="modal fade" id="{{'ventana_notificar_tramitador'.$ad->id_pago}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header bg-primary">
          <h5 class="modal-title text-center" id="exampleModalLabel">Solicita información de tu trámite</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="salir_modal('{{'ventana_notificar_tramitador'.$ad->id_pago}}')">
            <span aria-hidden="true" >&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <form class="form-horizontal" method="POST" action="{{ route('notificar_tramitador') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Correo tramitador</label>

                    <div class="col-md-6">
                        <input id="email{{$ad->id_pago}}" type="email" class="form-control" name="email" value="{{ $ad->email }}" readonly  required autofocus>
                        <input type="hidden" name="id_anuncio" value="{{$compra->id_anuncio}}">
                        <input type="hidden" name="id_user_compra" value="{{$compra->id_anunciante}}">
                        <input type="hidden" name="id_pago" value="{{$compra->id_pago}}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Mensaje</label>
                    <div class="col-md-6">
                       
                        <textarea name="mensaje" class="form-control" rows="8" cols="100"></textarea>
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
                            <button type="submit" class="btn btn-primary">
                                Notificar al tramitador
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="salir_modal('{{'ventana_notificar_tramitador'.$ad->id_pago}}')">SALIR</button>
        </div>
      </div>
    </div>
</div>


