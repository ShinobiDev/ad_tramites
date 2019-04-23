<table id="users-table" class="table table-striped table-codensed table-hover table-resposive">
      <thead>
        <tr class="bg-primary">
          <th class="text-center ">Trámite</th>
          <th class="text-center ">Descripción</th>
          <th class="text-center">Ciudad</th>
          <th class="text-center ">Valor</th>
          <th class="text-center">Calificación</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody id="tbbody">
        {{--se crean las tablas de ventas--}}
        @foreach ($anuncios as $ad)

         <tr id="row_{{$ad->id}}">
            <td class="text-green text-center bg-success">
              <strong><h4> {{$ad->nombre_tramite}}</h4></strong>              
            </td>

            <td class="text-center" ><strong><h5 class="text-justify">{{$ad->descripcion}}</h5></strong></td>

            <td class="text-center  bg-info"><h5><b>{{$ad->ciudad}}</b></h5></td>

            <td class="bg-warning">

              <h5 class="text-info "><span class="text-red">$</span><b>{{number_format($ad->valor_tramite,0,',','.')}}</b></h5>

            </td>

            <td style="width:10%" >
              @include('partials.stars')
            </td>
            <td>
              @guest
                     <!--AQUI SE MUESTRA LOS BOTONES PARA LOGIN -->

                      <button id="{{'btn_'.$ad->cod_anuncio}}" type="button" class="btn btn-success btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_login'.$ad->id}}','{{$ad->id}}','0','info')">
                        <i class="fa fa-info-circle"> Ver info</i>
                      </button>

                      <button id="{{'btn_'.$ad->cod_anuncio}}" type="button" class="btn btn-default btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_login'.$ad->id}}','{{$ad->id}}','0','venta')">
                        <i class="fa fa-money"> Comprar</i>
                      </button>                      
              @else
                    @if($ad->btn_info)
                      @if($ad->visto!="")

                       <!--<a href="admin/anuncios_vistos" class="btn btn-primary">Ya lo Viste</a>-->
                        <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-primary btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'infogen'.$ad->id}}','{{$ad->id}}','0','info')">                        
                        <i class="fa fa fa-eye"> Ya lo Viste</i>
                        </button>
                        
                      @else
                        <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-success btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'infogen'.$ad->id}}','{{$ad->id}}','{{$ad->costo_clic}}','info')">
                        <i class="fa fa-info-circle"> Ver info</i>
                        </button>

                        <button id="{{'an_'.$ad->id}}" style="display: none;" type="button" class="btn btn-primary btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'infogen'.$ad->id}}','{{$ad->id}}','0','info')">
                          <i class="fa fa-eye"> Ya lo Viste</i>
                        </button>
                      @endif

                    @endif

                    @if($ad->btn_payu)
                      <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-default btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'infoventa'.$ad->id}}','{{$ad->id}}','0','compra')" >
                        <i class="fa fa-money"> Comprar</i>
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
