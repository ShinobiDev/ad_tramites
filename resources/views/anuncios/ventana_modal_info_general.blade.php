<div class="modal fade" id="{{'infogen'.$ad->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog" role="document" >
      <div class="modal-content">

        <div class="modal-header bg-primary">
          <h3 style="text-align: center;" class="modal-title" id="exampleModalLabel"><b>Información de tu Tramitador</b></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="salir_modal('{{'infogen'.$ad->id}}')">
            <span aria-hidden="true" >&times;</span>
          </button>
        </div>
        @if($ad->validez_anuncio=="Bloqueado")
          <div class="modal-body">
            <b class="text-red">Este anuncio se encuentra bloqueado y no lo podra ver la comunidad, por favor comunicate con el administrador de {{config('app.name')}} para hacer la respectiva verificación y activación.</b>
          </div>
        @endif
        <div class="modal-body">
          <h4><b class="text-green">Nombre del ofertante:</b> <b>{{$ad->nombre}}</b></h4>
        </div>
         <div class="modal-body">
          <h4><b class="text-green">Teléfono del ofertante: </b><b>{{$ad->telefono}}</b></h4> 
        </div>
         <div class="modal-body">
          <h4><b class="text-green">Correo del ofertante:</b><b> {{$ad->correo_ofertante}}</b></h4>
        </div>
        <div class="modal-body">
          <h4><b class="text-green">Horario de atención:  </b> <b>Desde {{explode("|",$ad->horarios->horario)[0]}} hasta  {{explode("|",$ad->horarios->horario)[1]}}</b></h4>
          
          {{--<b class="text-green">Estado: </b>
          @if($ad->estado_dia)
                {{$ad->horarios->estado}}
          @else
            Cerrado
          @endif--}}

        </div>
        <div class="modal-body">
          <h4><b class="text-green">Ciudad:</b>
          <b>{{$ad->ciudad}}</b>
          <br></h4>
        </div>
        <div class="modal-body">
          <h4><b class="text-green">Descripción:</b></h4>
          <h3><b>{{$ad->descripcion}}</b></h3>
        </div>
        <div class="modal-body">
            <h4><b class="text-green">Trámite: </b></h4>

            <h4><b class="text-red">{{$ad->nombre_tramite}}</b>   </h4>
               <h4><span
               class="text-red">$</span><span class="text-primary">{{number_format($ad->valor_tramite,0)}}</span></h4>

        </div>
        <div class="modal-body">
            <h4 class="text-green">Calificación del anunciante: </h4>
            @for($i=1;$i<=$ad->calificacion;$i++)
              @if($i<=5)
                <img  class="star" src="{{asset('img/star.png')}}">
                @endif
            @endfor
         </div>
         <div class="modal-body">
          <h6 class="text-info">Visto por última vez {{$ad->visto}}</h6>
        </div>
        <div class="modal-body" >
          <h4 class="text-success">Comentarios de otros usuarios: </h4>
          @include('partials.comentarios')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="salir_modal('{{'infogen'.$ad->id}}')">SEGUIR VIENDO ANUNCIOS</button>
        </div>
      </div>
    </div>
</div>
