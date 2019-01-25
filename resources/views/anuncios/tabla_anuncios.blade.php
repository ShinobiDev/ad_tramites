<table id="users-table" class="table table-striped table-codensed table-hover table-resposive">
      <thead>
        <tr>
          <th class="text-center">Trámite</th>
          <th class="text-center">Descripción</th>
          <th class="text-center">Ciudad</th>
          <th class="text-center" style="width:25%">Valor</th>
          <th class="text-center">Calificación</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody id="tbbody">
        {{--se crean las tablas de ventas--}}
        @foreach ($anuncios as $ad)

         <tr>
            <td class="text-green text-center">
              <strong><h4> {{$ad->nombre_tramite}}</h4></strong>              
            </td>

            <td class="text-center" style="width:30%"><strong><h5>{{$ad->descripcion}}</h5></strong></td>

            <td class="text-center"><strong><h5>{{$ad->ciudad}}</h5></strong></td>

            <td class="text-center" style="width:25% padding: 0px">

              <strong style="margin: 0px;padding: 0px"><h5 style="margin: 0px;padding: 0px">$ {{number_format($ad->valor_tramite,0,',','.')}}</h5></strong>

            </td>

            <td style="width:10%">
              @include('partials.stars')
            </td>
            <td>
              @guest
                     <!--AQUI SE MUESTRA LOS BOTONES PARA LOGIN -->

                      <button id="{{'btn_'.$ad->cod_anuncio}}" type="button" class="btn btn-success" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_login'.$ad->id}}','{{$ad->id}}','0','info')">
                        Ver info
                      </button>

                      <button id="{{'btn_'.$ad->cod_anuncio}}" type="button" class="btn btn-default" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_login'.$ad->id}}','{{$ad->id}}','0','venta')">
                        Comprar
                      </button>

                      
              @else
                    @if($ad->btn_info)
                      @if($ad->visto!="")

                       <!--<a href="admin/anuncios_vistos" class="btn btn-primary">Ya lo Viste</a>-->
                        <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-primary" data-toggle="modal" onclick="descontar_recargar('{{ 'infogen'.$ad->id}}','{{$ad->id}}','0','info')">
                        Ya lo Viste
                        </button>
                     
                      @else
                        <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-success" data-toggle="modal" onclick="descontar_recargar('{{ 'infogen'.$ad->id}}','{{$ad->id}}','{{$ad->costo_clic}}','info')">
                        Ver info
                        </button>
                         <button id="{{'an_'.$ad->id}}" style="display: none;" type="button" class="btn btn-primary" data-toggle="modal" onclick="descontar_recargar('{{ 'infogen'.$ad->id}}','{{$ad->id}}','0','info')">
                        Ya lo Viste
                        </button>
                        
                        

                      @endif

                    @endif

                    @if($ad->btn_payu)
                      <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-default" data-toggle="modal" onclick="descontar_recargar('{{ 'infoventa'.$ad->id}}','{{$ad->id}}','0','compra')" >
                        Comprar
                      </button>

                    @endif



              @endguest


            </td>
           </tr>

        @endforeach
        {{--/se crean las tablas de ventas--}}
      </tbody>
</table>

@foreach ($anuncios as $ad)
              @guest
                     <!--AQUI SE MUESTRA LOS BOTONES PARA LOGIN -->
                      @include('anuncios.ventana_modal_login')            
              @else
                    @if($ad->btn_info)
                      @if($ad->visto!="")
                         @include('anuncios.ventana_modal_info_general')
                      @else
                        @include('anuncios.ventana_modal_info_general')
                      @endif
                    @endif
                    @if($ad->btn_payu)
                     @include('anuncios.ventana_modal_info_anuncio')
                    @endif
              @endguest
@endforeach
