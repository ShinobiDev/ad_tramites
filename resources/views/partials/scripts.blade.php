<script type="text/javascript">
      var url_global= "{{config('app.url')}}/";
       /*peticion que hace cambio del campo signature*/
      function cambiar_datos_recarga(){
          document.getElementById("btn_recarga").style.display='none';
          var val=document.getElementById("num_valor_recarga").value;
          var ref=document.getElementById("refRecarga").value.split("-")[0];

          var add_ref=Date.now().toString().substr(-2,2);
          var hs=ref+"-"+add_ref+"/"+val+"/COP";
          
          document.getElementById("refRecarga").value=ref+"-"+add_ref;


          document.getElementById("hd_val_recarga").value=val;
          peticion_ajax("get","hash/"+hs,function(rs){
                   
             
             document.getElementById("hd_signature_recarga").value=rs.valor;
             document.getElementById("btn_recarga").style.display='';
             
          });  
        }
       /*funcion que hace la peticion ajax */ 
      function peticion_ajax(metodo,url,data,func){
              //debe ir como core y no public la url en producccion
             $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
             //console.log(url_global+url);
             $.ajax({
                   type: metodo,
                   url: url_global+url,
                   data:{data},
                   dataType: "json",
                   success: function(result){
                         
                         func(result);
                   },
                   error: function(err){
                        console.log(err);
                   }
               });
          }
      /*funcion que hace la peticion ajax vistas*/ 
      function peticion_ajax_vistas(metodo,url,data,func){
              //debe ir como core y no public la url en producccion
             $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
             //console.log(url_global+url);
             $.ajax({
                   type: metodo,
                   url: url_global+url,
                   data:{data},
                   //dataType: "json",
                   success: function(result){
                         
                         func(result);
                   },
                   error: function(err){
                        console.log(err);
                   }
               });
       }
        /*Funcion tomada del sitio 
         * http://www.antisacsor.com/articulo/10_98_dar-formato-a-numeros-en-javascript
         * Para dar formato a los numeros*/
        /**
         * Da formato a un número para su visualización
         *
         * @param {(number|string)} numero Número que se mostrará
         * @param {number} [decimales=null] Nº de decimales (por defecto, auto); admite valores negativos
         * @param {string} [separadorDecimal=","] Separador decimal
         * @param {string} [separadorMiles=""] Separador de miles
         * @returns {string} Número formateado o cadena vacía si no es un número
         *
         * @version 2014-07-18
         */
        function number_format(numero, decimales, separador_decimal, separador_miles){ // v2007-08-06
            numero=parseFloat(numero);
            if(isNaN(numero)){
                return "";
            }

            if(decimales!==undefined){
                // Redondeamos
                numero=numero.toFixed(decimales);
            }

            // Convertimos el punto en separador_decimal
            numero=numero.toString().replace(".", separador_decimal!==undefined ? separador_decimal : ",");

            if(separador_miles){
                // Añadimos los separadores de miles
                var miles=new RegExp("(-?[0-9]+)([0-9]{3})");
                while(miles.test(numero)) {
                    numero=numero.replace(miles, "$1" + separador_miles + "$2");
                }
            }
            
            return numero;
        }      
        /**
         * Funcion para crear el hash necesario para enviar peticion payu
         * @param  {[type]} id          [description]
         * @param  {[type]} cod_anuncio [description]
         * @param  {[type]} moneda      [description]
         * @return {[type]}             [description]
         */
        function cambiar_valor_form_payu(id,cod_anuncio,moneda){
          var val =document.getElementById("num_val_crip_moneda_"+id).value;
          var cant=document.getElementById("num_cantidad_moneda_"+id).value;
          var t=parseFloat(cant)/parseFloat(val);
          
          document.getElementById("h5Total_"+id).value=t;
          document.getElementById("h5Total_"+id).innerHTML=number_format(t,2,",",".")+" ";
          
          var hs="admin/hash/"+cod_anuncio+"/"+cant+"/"+moneda;
          
          document.getElementById("hd_valor_venta_"+id).value=cant;
          document.getElementById("btn_comprar_"+id).style.display='none'; 

          peticion_ajax("get",hs,function(rs){
            document.getElementById("hd_signature_"+id).value=rs.valor;
            document.getElementById("hd_description_"+id).value=document.getElementById("hd_description_"+id).value.split(" cant # " )[0]+" cant # " +number_format(t,2,",",".");
            document.getElementById("btn_comprar_"+id).style.display=''; 
          });
        }
        /*funcion para cambiar el es estado de un anuncio*/
        function cambiar_estado(id){
          var rng=document.getElementById("rng_"+id).value;
          mostrar_cargando("h5_estado_"+id,10,"Un momento, por favor...");
           peticion_ajax("get","admin/cambiar_estado_anuncio/"+id+"/"+rng,{},function(rs){
              
              var es="";
              if(rs.respuesta[0].estado_anuncio=='1'){
                es='Activo';
              }else{
                es='Inactivo';
              }
              document.getElementById("h5_estado_"+id).innerHTML=es;
           });
        }
        /**
         * [funcion para mostrar cargando luego de enviar la peticion a el servidor]
         * @param  {[type]} el [description]
         * @return {[type]}    [description]
         */
        function mostrar_cargando(el,width,msn){
          $('#'+el).html('<div class="loading text-green"><img src="https://k46.kn3.net/taringa/C/7/8/D/4/A/vagonettas/5C9.gif" width="'+width+'" alt="loading" /><br/>'+msn+'</div>');
        }
        function mensaje(rs){
            var evento;
            if(rs.respuesta){
              evento='success';
            }else{
              evento='danger';
            }
        console.log(document.getElementById("div_alert"));    
        document.getElementById("div_alert").style.display='';
        document.getElementById("stMensaje").innerHTML=rs.mensaje;
        document.getElementById("div_alert").classList.add('alert-'+evento);
        document.getElementById("div_alert").classList.add('alert-dismissible');
        document.getElementById("div_alert").classList.add('fade');
        document.getElementById("div_alert").classList.add('in');
        document.getElementById("div_alert").classList.add('text-center');
        
      }
</script>
<script type="text/javascript">
  /**
   * Funcion para buscar anuncios
   * @param  {[type]} tipo [description]
   * @return {[type]}      [description]
   */
  function buscar_anuncios(tipo){
    console.log(tipo);
    


    var el=document.getElementById('formTramites').tramite;
    var sel=[];
    for(var f in el){
      if(el[0].value == 0 && el[0].checked == false){
        if(el[f].checked){
          sel.push(el[f].value);
        }  
      }
      
      
    }
    console.log(sel);
    if(sel.length>0){
      peticion_ajax_vistas("POST","admin/anuncios_por_tramite",{datos:sel,tipo:tipo},function(rs){
        console.log(rs); 
        $('#tbbody').html(rs);
        
      });
    }
      
    
  }
  /**
   * Funcion para dibujar tabla
   * @return {[type]} [description]
   */
  function draw_table(rs,tipo){
    console.log(rs.datos);
    var tbl=document.getElementById('tbbody');
    tbl.innerHTML="";
    var datos=rs.datos;
    for(var d in datos){
      var tr=document.createElement('tr');
      
      var td=document.createElement('td');
      td.className="text-green text-center";
      var st=document.createElement('strong');
      var h3=document.createElement('h5');
      h3.innerHTML=datos[d].nombre_tramite;
      st.appendChild(h3);
      td.appendChild(st);
      tr.appendChild(td);
      tbl.appendChild(tr);

      var td=document.createElement('td');
      td.className="text-center";
      var st=document.createElement('strong');
      var h3=document.createElement('h5');
      h3.innerHTML=datos[d].descripcion;
      st.appendChild(h3);
      td.appendChild(st);
      tr.appendChild(td);
      tbl.appendChild(tr);

      var td=document.createElement('td');
      td.className="text-center";
      var st=document.createElement('strong');
      var h3=document.createElement('h5');
      h3.innerHTML=datos[d].ciudad;
      st.appendChild(h3);
      td.appendChild(st);
      tr.appendChild(td);
      tbl.appendChild(tr);

      var td=document.createElement('td');
      td.className="text-center";
      var st=document.createElement('strong');
      var h3=document.createElement('h5');
      h3.innerHTML="$ "+number_format(datos[d].valor_tramite,2,",",".");
      st.appendChild(h3);
      td.appendChild(st);
      tr.appendChild(td);
      tbl.appendChild(tr);

      var td=document.createElement('td');
      td.className="text-center";
      
      
      for(var i=0;i<datos[d].calificacion;i++){
        if(i<=3){
          var img=document.createElement('img');
          img.className="star";
          img.src="{{asset('img/star.png')}}";  
        }
        

      }
      if(datos[d].calificacion!="0.0"){
        td.appendChild(img);  
      }
      tr.appendChild(td);
      tbl.appendChild(tr);


      var td=document.createElement('td');
      
      switch(tipo){
        case "anuncios":
          if(datos[d].visto!=""){
            var a=document.createElement("a");
            a.className="btn btn-primary";
            a.href="admin/anuncios_vistos";
            td.appendChild(a);             
          }else{

          }
        break;
      }
      

      tr.appendChild(td);
      tbl.appendChild(tr);

    }
  }
</script>