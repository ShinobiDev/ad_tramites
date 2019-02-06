<table id="users-table" class="table table-striped table-codensed table-hover table-resposive">
  <thead>
    <tr>
      <th>Campaña</th>
      <th>Usuario</th>
      <th>Fecha validez</th>      
      <th>Valor descuento</th>
      <th>Cantidad de cupones creados</th>
      <th>Acciones</th>
    </tr>
  </thead>
   <tbody id="tbbody">
    {{--se crean las tablas de campañas--}}
         
        @foreach($campanias as $c)
        <tr>
          <td>{{$c->nombre_campania}}</td>
          @if($c->id_user==NULL)
            <td><span class="text-danger">ABIERTA</span></td>
          @else
            <td><span class="text-success">{{$c->usuario->nombre}}</span></td>
          @endif
          
          @if($c->fecha_vigencia==NULL)
            <td><span class="text-danger">ABIERTA</span></td>
          @else
            <td><span class="text-success">{{$c->fecha_vigencia}}</span></td>
          @endif
          <td class="text-center">{{$c->porcentaje_de_descuento}}%</td>
          <td class="text-center">{{$c->numero_de_cupones}}</td>
          <td>
           <button  class="btn btn-primary" data-toggle="modal" href="#ver_cupones" onclick="ver_campania('{{$c->id}}','{{$c->nombre_campania}}')">Ver campaña</button>
          </td>
          
        </tr>  
        @endforeach
      
    {{--/se crean las tablas de campañas--}}
  </tbody>
</table>

<h3>Listado de cupones</h3>
<div id="div_cupones">
  <table id="cupones-table" class="table table-striped table-codensed table-hover table-resposive">
  <thead>
    <tr>
      <th>Campaña</th>
      <th>Código cupon</th>
      <th>Fecha de canje</th>
      <th>Usuario que canjeo</th>
      <th>Valor descuento</th>
      <th>Acciones</th>
    </tr>
  </thead>
   <tbody id="tbbody1">
    {{--se crean las tablas de campañas--}}
      
        @foreach($campanias as $c)
          @foreach($c->cupones as $cupon)
            <tr>
              <td>{{$c->nombre_campania}}</td>
              <td>{{$cupon->codigo_cupon}}</td>
              <td>
                @if($cupon->fecha_canje!="")
                  {{$cupon->fecha_canje}}</td>
                @else
                  <span class="text-red">SIN CANJER</span>
                @endif  
              <td>
                @if($cupon->fecha_canje!="")
                  {{$cupon->usuario->nombre}}</td>
                @else
                  <span class="text-red">SIN CANJER</span>
                @endif  

              <td>{{$c->porcentaje_de_descuento}}%</td>
              <td>
                @if($cupon->fecha_canje!="")
                  <span class="text-success">CANJEADO</span>
                @else

                  <button  class="btn btn-danger" data-toggle="modal"  onclick="eliminar_cupones('{{$cupon->id}}','{{$c->nombre_campania}}','{{$c->id}}')" >Eliminar cupon</button>
                  
                @endif
              </td>
              
            </tr>  
          @endforeach
        @endforeach
      
    {{--/se crean las tablas de campañas--}}
  </tbody>
</table>
  
</div>

 

  <script type="text/javascript">
  function ver_campania(id,buscar){
     
        $.ajax({
            type: 'GET', 
            url : "ver_cupones/"+id, 
            success : function (data) {
                
                
                $('#cupones-table').DataTable().search(
                    buscar,
                    false,
                    false,                    
                ).draw();
                
            }
        });
      
     
      
    }
     function eliminar_cupones(id,nombre,id_campana){
     
        $.ajax({
            type: 'GET', 
            url : "eliminar_cupon/"+id+"/"+id_campana, 
            success : function (data) {
              
                $('#cupones-table').DataTable().search(
                    nombre,
                    false,
                    false,                    
                ).draw();

                if(data.reload){
                  location.reload();
                }
                
            }
        });
    }

    /* peticion_ajax("get","admin/ver_cupones/"+id,{},function(rs){
        console.log(rs);
        var ls=document.getElementById("tbbody1");
        ls.innerHTML="";
        for(var f in rs.datos){
          console.log(rs.datos[f]);

          var tr=document.createElement("tr");

          var td=document.createElement("td");
          td.innerHTML=nombre;
          tr.appendChild(td);

          
          var td=document.createElement("td");
          td.innerHTML=rs.datos[f].codigo_cupon;
          tr.appendChild(td);

          fecha_canje=rs.datos[f].fecha_canje;
          if(rs.datos[f].fecha_canje==null){
              fecha_canje='Sin canjear';
          }

          var td=document.createElement("td");
          td.innerHTML=fecha_canje;
          tr.appendChild(td);
          

          
          var td=document.createElement("td");
          td.innerHTML=rs.datos[f].id_usuario_canje;
          tr.appendChild(td);

          var td=document.createElement("td");
          td.innerHTML=rs.datos[f].id_usuario_canje;
          tr.appendChild(td);

          var td=document.createElement("td");
          td.innerHTML="**";
          tr.appendChild(td);
          
         ls.appendChild(tr);
          
         
        }

     });
  }*/

</script>

    
