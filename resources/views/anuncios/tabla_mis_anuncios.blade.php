 <table id="users-table" class="table table-striped table-codensed table-hover table-resposive">
  <thead>
    <tr>
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
          <td class="text-green text-center" style="width: 10%">
            <strong>
              <h4>{{$ad->nombre_tramite}}</h4>
            </strong>
          </td>
          <td class=" text-center" style="width:20%"><strong><h5 class="text-justify">{{$ad->descripcion}}</h5></strong></td>
          <td class=" text-center" style="width:15%"><strong><h5>{{$ad->ciudad}}</h5></strong></td>
          <td class="text-center" style="width:25% padding: 0px">

            <strong style="margin: 0px;padding: 0px"><h5 style="margin: 0px;padding: 0px">${{number_format($ad->valor_tramite,0,',','.')}}</h5></strong>

          </td>
          @role('Admin')
              <td class=" text-center"><strong><h5> {{$ad->nombre}}</h5></strong></td>
              <td>
                  @if($ad->validez_anuncio=="Activo")
                    

                    
                    
                     <div class="col-12 col-md-12  col-lg-2 col-sm-4">
                      
                      <h5 class="col-4 col-md-4 col-lg-4 col-sm-4" id="h5_estado_{{$ad->id}}">Activo</h5>  
                      <input  style="width: 50px"  id="rng_{{$ad->id}}" type="range" min="1" max="2" value="1" onchange="cambiar_estado_admin('{{$ad->id}}')" >  
                      
                      <label class="col-4 col-md-4 col-lg-4 col-sm-4">Activo-Bloqueado</label>
                    </div>
                  
                  @elseif($ad->validez_anuncio=="Bloqueado")
                    
                    
                  
                     <div class="col-10 col-md-10 col-lg-2 col-sm-4">
                      <h5 id="h5_estado_{{$ad->id}}" class="col-4 col-md-4 col-lg-4 col-sm-4 text-danger">Bloquedo</h5>
                      <input style="width: 50px"  id="rng_{{$ad->id}}" type="range" min="1" max="2" value="2" onchange="cambiar_estado_admin('{{$ad->id}}')" >
                      <label class=" col-4  col-md-4 col-lg-4 col-sm-4">Activo-Bloqueado</label>
                      
                    </div>
                 
                  @else
                    
                    
                     <div class="col-10 col-md-10 col-lg-2 col-sm-4">
                      <h5 id="h5_estado_{{$ad->id}}" class="col-4 col-md-4 col-lg-4 col-sm-4 text-danger">Sin publicar</h5>
                      <input  style="width: 50px"  id="rng_{{$ad->id}}" type="range" min="0" max="2" value="0" onchange="activar_anuncio_admin('{{$ad->id}}')">
                      <label class=" col-4  col-md-4 col-lg-4 col-sm-4">Sin publicar-Activo-Bloqueado</label>                      
                      </div>

                  @endif
                 

              </td>
          @endrole
          @role('Anunciante')
            
              <td>
              @if($ad->validez_anuncio=='Activo')
                  @if($ad->estado_anuncio=="1")
                    <h5 id="h5_estado_{{$ad->id}}" style="margin-left:25%;">Activo</h5>

                    <input id="rng_{{$ad->id}}" type="range" min="0" max="1" value="1" onchange="cambiar_estado('{{$ad->id}}')" style="width: 50%; margin-left:25%; ">
                  @else
                    <h5 id="h5_estado_{{$ad->id}}" style="margin-left:25%;">Inactivo</h5>
                    <input id="rng_{{$ad->id}}" type="range" min="0" max="1" value="0" onchange="cambiar_estado('{{$ad->id}}')" style="width: 50%; margin-left:25%; ">
                  @endif
                   <div style="margin-left: 100px" class="col-12"><label class="col-5">Inactivo</label><label class="col-1">-</label><label class="col-5">Activo</label></div>
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