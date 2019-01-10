<div class="modal fade" id="{{'infogen'.$ad->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog" role="document" >
      <div class="modal-content">

        <div class="modal-header bg-primary">
          <h3 style="text-align: center;" class="modal-title" id="exampleModalLabel"><b>Información del ofertante</b></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="salir_modal('{{'infogen'.$ad->id}}')">
            <span aria-hidden="true" >&times;</span>
          </button>
        </div>
        @if($ad->validez_anuncio=="0")
          <div class="modal-body">
            <b class="text-red">Este anuncio se encuentra bloqueado y no lo podra ver la comunidad, por favor comunicate con el administrador de {{config('app.name')}} para hacer la respectiva verificación y activación</b>
          </div>
        @endif
        <div class="modal-body">
          <b>Nombre del ofertante:</b> {{$ad->nombre}}
        </div>
         <div class="modal-body">
          <b>Teléfono del ofertante:</b> {{$ad->telefono}}
        </div>
         <div class="modal-body">
          <b>Correo del ofertante:</b> {{$ad->correo_ofertante}}
        </div>
        <div class="modal-body">
          <b>Horario de atención:  </b> Desde {{explode("|",$ad->horarios->horario)[0]}} hasta  {{explode("|",$ad->horarios->horario)[1]}}
          <b>Estado: </b>
          @if($ad->estado_dia)
                {{$ad->horarios->estado}}
          @else
            Cerrado
          @endif
        </div>
        <div class="modal-body">
          <b>Ciudad:</b>
          {{$ad->ciudad}}
          <br>
        </div>
        <div class="modal-body">
          <b>Descripción:</b>
          <p>{{$ad->descripcion}}</p>
        </div>
        <div class="modal-body">
            <h4>Tramite: </h4>
            <h6><b>{{$ad->nombre_tramite}}</b> $ {{number_format($ad->valor_tramite,0)}}  </h6>
        </div>
        <div class="modal-body">
            <h4>Calificación del anunciante: </h4>
            @for($i=1;$i<=$ad->calificacion;$i++)
              @if($i<=5)
                <img  class="star" src="{{asset('img/star.png')}}">
                @endif
            @endfor
         </div>
         <div class="modal-body">
          <h6>Visto por última vez {{$ad->visto}}</h6>
        </div>
        <div class="modal-body" >
          <h4>Comentarios de otros usuarios: </h4>
          @include('partials.comentarios')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="salir_modal('{{'infogen'.$ad->id}}')">SEGUIR VIENDO ANUNCIOS</button>
        </div>
      </div>
    </div>
</div>
