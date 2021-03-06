<table id="users-table" class="table table-striped table-codensed table-hover table-resposive">
        <thead>
          <tr class="bg-primary">
            <th class="text-center col-1 col-md-1  col-sm-1 col-xs-1" >ID</th>
            <th class="text-center">Trámite</th>
            <th class="text-center">Descripción</th>
            <th class="text-center">Ciudad</th>
            <th class="text-center">Valor</th>
            <th class="text-center">Nombre usuario</th>
            <th class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody id="tbbody">
          {{--se crean las tablas de ventas--}}
          @foreach ($anuncios as $ad)
              {{--dd($ad)--}}
              @if($ad->validez_anuncio=='Activo')
                  <tr>
                  <td class="text-green text-center bg-info"><strong><h5>{{$ad->id}}-</h5></strong></td>  
                  <td class="text-green text-center"><strong><h4>{{$ad->nombre_tramite}}</h4></strong></td>
                  <td class="text-center bg-warning"><strong><h5 class="text-justify">{{$ad->descripcion}}</h5></strong></td>
                  <td class="text-center"><h5><strong>{{$ad->ciudad}}</strong></h5></td>
                  <td class=" bg-danger text-center"><strong><h5 class="text-primary"><span class="text-red">$</span>{{number_format($ad->valor_tramite,0,',','.')}}</h5></strong></td>
                  <td>
                   <strong><h5>{{$ad->nombre}}</h5></strong>
                  </td>
                 <td>
                    @guest
                           <!--AQUI SE MUESTRA LOS BOTONES PARA LOGIN -->

                            <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-success btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_login'.$ad->id}}','{{$ad->id}}','0',false)">
                              <i class="fa fa-info-circle"> Ver info</i>
                              </button>

                            <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-default btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_login'.$ad->id}}','{{$ad->id}}','0',false)">
                              <i class="fas fa-hand-holding-usd"> Comprar</i>
                            </button>


                        
                    @else
                          @if($ad->btn_info)

                              <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-success btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'infogen'.$ad->id}}','{{$ad->id}}','0','info')">
                              <i class="fa fa-info-circle"> Ver info</i>
                              </button>

                              

                          @endif

                          @if($ad->btn_payu)
                            <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-default btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'infoventa'.$ad->id}}','{{$ad->id}}','0','compra')" >
                              <i class="fa fa-money"> Comprar</i>
                            </button>

                           
                          @endif

                          @if($ad->btn_calificar)
                             <button id="{{'btn_cal_'.$ad->id}}" type="button" class="btn btn-primary btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'infocalificar'.$ad->id}}','{{$ad->id}}','0',false)" >
                              <i class="fa fa-thermometer-3"> Calificar</i>
                            </button>
                             
                          @endif

                    @endguest
                  </td>
                 </tr>
              @endif
          @endforeach
          {{--/se crean las tablas de ventas--}}
        </tbody>
</table>
<!--aqui creo las ventanas-->
@foreach ($anuncios as $ad)
              {{--dd($ad)--}}
      @if($ad->validez_anuncio=='Activo')
            @guest
                  @include('anuncios.ventana_modal_login')
            @else
                  @if($ad->btn_info)
                      @include('anuncios.ventana_modal_info_general')
                  @endif
                  @if($ad->btn_payu)
                      @include('anuncios.ventana_modal_info_anuncio')
                  @endif
                  @if($ad->btn_calificar)
                     @include('partials.btn_calificar_anunciante')
                  @endif
            @endguest
      @endif
@endforeach