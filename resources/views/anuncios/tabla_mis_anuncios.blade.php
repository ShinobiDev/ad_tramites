 <table id="users-table" class="table table-striped table-codensed table-hover table-resposive">
  <thead>
    <tr class="bg-primary">
      <th>Trámite</th>
      <th>Descripción   </th>
      <th>Ciudad</th>
      <th>Valor    </th>
      @role("Admin")
        <th>Usuario</th>
      @endrole
      <th>Estado anuncio</th>
      <th>Acciones</th>
    </tr>
  </thead>
   <tbody id="tbbody">
    {{--se crean las tablas de ventas--}}
    @foreach ($anuncios as $ad)

         <tr>
          <td class="text-green text-center bg-success" style="width: 10%">
            <strong>
              <h4>{{$ad->nombre_tramite}}</h4>
            </strong>
          </td>
          <td class=" text-center" style="width:20%"><strong><h5 class="text-justify">{{$ad->descripcion}}</h5></strong></td>
          <td class=" text-center bg-info" style="width:15%"><h5><strong>{{$ad->ciudad}}</strong></h5></td>
          <td class="text-center" style="width:25% padding: 0px">

            <h5 class="text-primary" style="margin: 0px;padding: 0px"><strong style="margin: 0px;padding: 0px"><label class="text-red">$</label>{{number_format($ad->valor_tramite,0,',','.')}}</strong></h5>

          </td>
          @role('Admin')
              <td class=" text-center bg-danger"><strong><h5> {{$ad->nombre}}</h5></strong></td>
              <td>
                  @if($ad->validez_anuncio=="Activo")
                    

                    
                    
                     
                      
                      <h5 id="h5_estado_{{$ad->id}}" class="text-red" style="width: 150px">{{$ad->validez_anuncio}}</h5>
                      <div>                              
                              <select class="form-control" onchange="cambiar_estado_admin('{{$ad->id}}',this)">
                                <option value="2">Bloqueado</option>
                                <option value="1" selected>Activo</option>
                              </select>
                      </div>

                    
                  
                  @elseif($ad->validez_anuncio=="Bloqueado")
                    
                      
                      <h5 id="h5_estado_{{$ad->id}}" class="text-red" style="width: 150px">{{$ad->validez_anuncio}}</h5>
                      <div>                              
                              <select class="form-control" onchange="cambiar_estado_admin('{{$ad->id}}',this)">      
                                <option value="2" selected>Bloqueado</option>
                                <option value="1">Activo</option>                
                              </select>
                      </div>

                    

                    
                  
                 
                  @else
                    
                    
                     
                      
                      <h5 id="h5_estado_{{$ad->id}}" class="text-red" style="width: 150px">{{$ad->validez_anuncio}}</h5>
                      <div>                              
                              <select class="form-control" onchange="cambiar_estado_admin('{{$ad->id}}',this)">
                                <option value="0" selected>Sin publicar</option>
                                <option value="2" >Bloqueado</option>
                                <option value="1">Activo</option>
                              </select>
                      </div>

                    

                  @endif
                 

              </td>
          @endrole
          @role('Anunciante')
            
              <td class="bg-danger">
              @if($ad->validez_anuncio=='Activo')
                  @if($ad->estado_anuncio=="1")


                    <h5 id="h5_estado_{{$ad->id}}" class="text-red" style="width: 150px">Activo</h5>
                      <div>                              
                              <select class="form-control" onchange="cambiar_estado_admin('{{$ad->id}}',this)">
                                <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>
                              </select>
                      </div>

                  @else
                     <h5 id="h5_estado_{{$ad->id}}" class="text-red" style="width: 150px">Inactivo</h5>
                      <div>                              
                              <select class="form-control" onchange="cambiar_estado_admin('{{$ad->id}}',this)">
                                <option value="1">Activo</option>
                                <option value="0" selected>Inactivo</option>
                              </select>
                      </div>
                  @endif
                   
              @else
                <h5 id="h5_estado_{{$ad->id}}" style="margin-left:25%;" class="text-danger">{{$ad->validez_anuncio}}</h5>
              @endif
            </td>
          @endrole
         <td>
            @guest
                   <!--AQUI SE MUESTRA LOS BOTONES PARA LOGIN -->

                    <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-success btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_login'.$ad->id}}','{{$ad->id}}','0','info')">
                      Ver info
                      </button>

                    <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-default btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'ventana_login'.$ad->id}}','{{$ad->id}}','0','venta')">
                      Comprar
                    </button>                
            @else
                     <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-success btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'infogen'.$ad->id}}','{{$ad->id}}','0','info')">
                      Ver info
                      </button>                    

                  @if($ad->btn_payu)
                    <button id="{{'btn_'.$ad->id}}" type="button" class="btn btn-default btn-block" data-toggle="modal" onclick="descontar_recargar('{{ 'infoventa'.$ad->id}}','{{$ad->id}}','0','compra')" >
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
<!--ventanas-->
@foreach ($anuncios as $ad)        
            @guest
                @include('anuncios.ventana_modal_login')
            @else
                  @include('anuncios.ventana_modal_info_general')

                @if($ad->btn_payu)
                 
                  @include('anuncios.ventana_modal_info_anuncio')
                @endif
            @endguest
@endforeach