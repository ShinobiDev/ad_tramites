{{--se crean las tablas de ventas--}} 
                  
                  @foreach ($anuncios as $ad)
                      
                       <tr>
                        <td class="text-green text-left"><strong><h4 style=" margin:2%; ">{{$ad->nombre_tramite}}</h4></strong></td>
                        <td class=" text-left"><strong><h5>{{$ad->descripcion}}</h5></strong></td>
                        <td class=" text-left"><strong><h5>{{$ad->ciudad}}</h5></strong></td>
                        <td class=" text-center"><strong><h5>$ {{number_format($ad->valor_tramite,2,',','.')}}</h5></strong></td>
                        <td>
                         
                          
                          
                          @if($ad->estado_anuncio=="1")
                            <h5 id="h5_estado_{{$ad->id}}" style="margin-left:25%;">Activo</h5>

                            <input id="rng_{{$ad->id}}" type="range" min="0" max="1" value="1" onchange="cambiar_estado('{{$ad->id}}')" style="width: 50%; margin-left:25%; ">
                          @else
                            <h5 id="h5_estado_{{$ad->id}}" style="margin-left:25%;">Inactivo</h5>
                            <input id="rng_{{$ad->id}}" type="range" min="0" max="1" value="0" onchange="cambiar_estado('{{$ad->id}}')" style="width: 50%; margin-left:25%; ">
                          @endif

                          




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
                            
                             
                              
                             
                                  
                                    <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-success" data-toggle="modal" onclick="descontar_recargar('{{ 'infogen'.$ad->id}}','{{$ad->id}}','0','info')">
                                    Ver info
                                    </button>
                                                        
                                    @include('anuncios.ventana_modal_info_general')


                                  
                                  
                                                           

                                @if($ad->btn_payu)  
                                  <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-default" data-toggle="modal" onclick="descontar_recargar('{{ 'infoventa'.$ad->id}}','{{$ad->id}}','0','compra')" >
                                    Comprar
                                  </button>
                                
                                @include('anuncios.ventana_modal_info_anuncio')
                                @endif
                              
                              

                          @endguest
                            
                            
                        </td>
                       </tr>
                     
                  @endforeach
                  {{--/se crean las tablas de ventas--}} 