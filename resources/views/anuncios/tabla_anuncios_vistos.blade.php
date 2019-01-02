<table id="users-table" class="table table-striped table-codensed table-hover table-resposive">
                            <thead>
                              <tr>
                                <th class="text-center">Tramite</th>
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
                                  @if($ad->validez_anuncio==1)
                                      <tr>
                                      <td class="text-green text-center"><strong><h4>{{$ad->nombre_tramite}}</h4></strong></td>
                                      <td class="text-center"><strong><h5>{{$ad->descripcion}}</h5></strong></td>
                                      <td class="text-center"><strong><h5>{{$ad->ciudad}}</h5></strong></td>
                                      <td class="text-center"><strong><h5>$ {{number_format($ad->valor_tramite,0,',','.')}}</h5></strong></td>
                                      <td>
                                       <strong><h5>{{$ad->nombre}}</h5></strong>
                                      </td>
                                     <td>
                                        @guest
                                               <!--AQUI SE MUESTRA LOS BOTONES PARA LOGIN -->

                                                <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-success" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_login'.$ad->id}}','{{$ad->id}}','0','info')">
                                                  Ver info
                                                  </button>

                                                <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-default" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_login'.$ad->id}}','{{$ad->id}}','0','venta')">
                                                  Comprar
                                                </button>


                                            @include('anuncios.ventana_modal_login')
                                        @else
                                              @if($ad->btn_info)

                                                  <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-success" data-toggle="modal" onclick="descontar_recargar('{{ 'infogen'.$ad->id}}','{{$ad->id}}','0','info')">
                                                  Ver info
                                                  </button>

                                                  @include('anuncios.ventana_modal_info_general')

                                              @endif

                                              @if($ad->btn_payu)
                                                <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-default" data-toggle="modal" onclick="descontar_recargar('{{ 'infoventa'.$ad->id}}','{{$ad->id}}','0','compra')" >
                                                  Comprar
                                                </button>

                                               @include('anuncios.ventana_modal_info_anuncio')
                                              @endif

                                              @if($ad->btn_calificar)
                                                 <button id="{{'btn_cal_'.$ad->id}}" type="button" class="btn btn-primary" data-toggle="modal" onclick="descontar_recargar('{{ 'infocalificar'.$ad->id}}','{{$ad->id}}','0','compra')" >
                                                  Calificar
                                                </button>
                                                 @include('partials.btn_calificar_anunciante')
                                              @endif

                                        @endguest
                                      </td>
                                     </tr>
                                  @endif
                              @endforeach
                              {{--/se crean las tablas de ventas--}}
                            </tbody>
</table>
