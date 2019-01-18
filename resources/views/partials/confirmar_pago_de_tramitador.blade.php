 <div class="modal fade" id="{{'ventana_pago_de_tramitador'.$ad->id_pago}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header bg-primary">
          <h5 class="modal-title text-center" id="exampleModalLabel">Confirmar que se  te realizo el pago de la transacción</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="salir_modal('{{'ventana_pago_de_tramitador'.$ad->id_pago}}')">
            <span aria-hidden="true" >&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <form class="form-horizontal" method="POST" action="{{ route('notificar_pago_de_tramitador') }}">
                {{ csrf_field() }}

                <h4 class="text-center">¿Estás seguro de confirmar el pago hecho por {{config('app.name')}}?</h4>
                <input type="hidden" name="id_pago" value="{{$ad->id_pago}}">                               
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <button type="submit" class="btn btn-success">
                                Confirmar pago
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="salir_modal('{{'ventana_pago_de_tramitador'.$ad->id_pago}}')">SALIR</button>
        </div>
      </div>
    </div>
</div>


