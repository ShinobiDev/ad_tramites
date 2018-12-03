 <div class="modal fade" id="{{'infoventa'.$ad->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            
            <div class="modal-header">
               <h3 style="text-align: center;" class="modal-title" id="exampleModalLabel"><b>Tramite garantizado</b></h3>
              <h4 class="modal-title" id="exampleModalLabel">{{config('app.name','') }}, te sirve de intermediario para garantizar que que puedas realizar tramites de manera segura </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="salir_modal('{{'infoventa'.$ad->id}}')">
                <span aria-hidden="true" >&times;</span>
              </button>
            </div>
            <div class="modal-header">
              <h4 style="text-align: center;" class="modal-title" id="exampleModalLabel"><b>Realiza tu tramite</b></h4>
            </div>
            <div class="modal-body">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
                <form method="POST" id="ad-form" action="{{$ad->url_api}}">
                          
                        <div class="modal-body">

                          
                          @if(Auth::user()->id!=$ad->id_anunciante)
                            @include('payu.botonpayu')
                          @endif
                        </div>  
                </form>    
            </div> 
            <div class="modal-body">
              {{--dd($ad->horarios)--}}
              <b>horarios de atención:  </b> Desde {{explode("|",$ad->horarios->horario)[0]}} hasta  {{explode("|",$ad->horarios->horario)[1]}}
              <b>Estado: </b> 
              @if($ad->estado_dia)
                {{$ad->horarios->estado}}
              @else
                Cerrado
              @endif  
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
          <div class="modal-footer">
              
              <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="salir_modal('{{'infoventa'.$ad->id}}')">SEGUIR VIENDO ANUNCIOS</button>
            </div>
          </div>
        </div>
</div>