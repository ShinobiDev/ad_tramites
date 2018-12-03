<!--anuncios-->
{{--dd($anuncios)--}} 
<div class="container-fluid">
 <div class="col-md-12 col-lg-offset-0">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Listados De Anuncios De Venta</h3>
            @guest
              <a href="{{route('login')}}" class="btn btn-primary pull-right btn-lg" >
                  <i class="fa fa-user-plus"> Crear Anuncio</i>
              </a>
              @else 
               <a href="{{route('anuncios.create')}}" class="btn btn-primary pull-right btn-lg" >
                  <i class="fa fa-user-plus"> Crear Anuncio</i>
              </a>
              @endguest 

      </div>
      <div class="row"> 
         <div class="box-body col-sm-2">
            @include('anuncios.filtro_tramites')
         </div>
         <div class="box-body col-sm-10">
              <table id="users-table" class="table table-striped table-codensed table-hover table-resposive">
                <thead>
                  <tr>
                    <th>Tramite</th>
                    <th>Descripción</th>
                    <th>Ciudad</th>
                    <th>Valor</th>
                    <th>Calificación</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
               
                <tbody id="tbbody">
                  {{--se crean las tablas de ventas--}} 
                  @foreach ($anuncios as $ad)
                      
                       <tr>
                        <td class="text-green text-center"><strong><h3>{{$ad->nombre_tramite}}</h3></strong></td>
                        
                        <td class=" text-center"><strong><h5>{{$ad->descripcion}}</h5></strong></td>

                        <td class=" text-center"><strong><h5>{{$ad->ciudad}}</h5></strong></td>

                        <td class=" text-center"><strong><h5>$ {{number_format($ad->valor_tramite,2,',','.')}}</h5></strong></td>

                        <td>
                          @for($i=1;$i<=$ad->calificacion;$i++)
                            @if($i<=5)
                              <img  class="star" src="{{asset('img/star.png')}}">
                              @endif
                          @endfor
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
                                 
                              
                              @include('anuncios.ventana_modal_login')  
                          @else
                            
                             
                                
                                @if($ad->btn_info) 
                                  @if($ad->visto!="") 
                                 
                                   <a href="admin/anuncios_vistos" class="btn btn-primary">Ya lo Viste</a>
                                                        
                                    
                                  @else
                                    <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-success" data-toggle="modal" onclick="descontar_recargar('{{ 'infogen'.$ad->id}}','{{$ad->id}}','{{$ad->costo_clic}}','info')">
                                    Ver info
                                    </button>
                                    <a id="an_{{$ad->id}}" href="admin/anuncios_vistos" class="btn btn-primary" style="display: none">Ya lo Viste</a>                    
                                    @include('anuncios.ventana_modal_info_general')


                                  @endif
                                  
                                @endif                                

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
                </tbody>
              </table>  
         </div>
      </div>



    </div>


 </div>
</div>
<!--anuncios-->


  