{{--se crean las tablas de ventas--}} 
                              @foreach ($anuncios as $ad)
                                  
                                   <tr>
                                    <td class="text-green text-center"><strong><h3>{{$ad->nombre_tramite}}</h3></strong></td>
                                    <td class=" text-center"><strong><h5>{{$ad->descripcion}}</h5></strong></td>
                                    <td class=" text-center"><strong><h5>{{$ad->ciudad}}</h5></strong></td>
                                    <td class=" text-center"><strong><h5>$ {{number_format($ad->valor_tramite,2,',','.')}}</h5></strong></td>
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
                                               <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-primary" data-toggle="modal" onclick="descontar_recargar('{{ 'infocalificar'.$ad->id}}','{{$ad->id}}','0','compra')" >
                                                Calificar
                                              </button>
                                               @include('partials.btn_calificar_anunciante')
                                            @endif  

                                      @endguest
                                    </td>
                                   </tr>
                              @endforeach
                              {{--/se crean las tablas de ventas--}} 