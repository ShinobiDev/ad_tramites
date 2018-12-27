@extends('layouts.app')

@section('head')
  {{-- content --}}
@endsection


@section('content')
      <body class="server-prod session-anonymous">
        <div class="container">
          <h1>Cree un anuncio para ofertar tramites</h1>


          <h3>Normas y requisitos de anuncios</h2>

            <noscript>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            Debe activar JavaScript para poder completar este formulario.
                        </div>
                    </div>
                </div>
            </noscript>

            <div class="row container">
                <h3>
                Para que tus anuncios sean visibles, debes tener saldo en la cuenta de recarga.
                Recuerda que cada click de tu anuncio tiene un valor de: $ {{number_format(Auth()->user()->costo_clic,0,"",".")}} COP
              </h3>
              <h2>BALANCE DE RECARGA: {{number_format(auth()->user()->valor_recarga,0,"",".")}} COP</h2>


              <div id="identification_hint" class="col-md-12 display-none">

                <div class="alert alert-info">

                    <h3>
                      <i class="fa fa-info-circle"></i>
                      ¿Quiere aumentar su visibilidad?, los anuncios son ordenados orgánicamente situando primero a los usuarios que tengan un mayor valor de recarga total
                    </h3>

                </div>
                <div class="alert alert-warning">
                    <h3>
                      <i class="fa fa-info-circle"></i>
                      Si tu servicio es comprado directamente en <a href="{{config('app.url')}}">{{config('app.name')}}</a>, el costo de este servicio es del x% 
                    </h3>
                </div>

              </div>
            </div>
              @include('partials.alert')
            <legend>Crea tu anuncio</legend>
            <div class="row " id="">
                <div id="" class="col-md-2 label-col form-group">
                  <!--<label for= "" class="control-label requiredField">Deseo...</label>-->
                </div>

           </div>
           <div class="row">
            
                @include('anuncios.formanuncio')
           </div>

            <footer>
            </footer>
          </div>
        
      </body>
@endsection

@include('partials.scripts')

@section('scripts')

<script>

$(document).ready(function() {

        
      $('input[name=tramites]').on('change',function(e){
        if(e!=undefined){
          if(e.target.checked){
            document.getElementById('div_tra_'+e.target.value).style.display="";  
          }else{
            document.getElementById('div_tra_'+e.target.value).style.display="none";  
            document.getElementById('tra_'+e.target.value).value="";  
            document.getElementById('des_tra_'+e.target.value).value="";  
          }
        }
          
          
        
      });
      $('label[name=lbl_tramite]').on('click',function(e){
          
          
          var id=e.target.id.split("_")[1];
          var el=document.getElementById("ch_"+id);
          
          if(el.checked==false){
            el.checked=true;
            document.getElementById('div_tra_'+id).style.display="";  

          }else{
            el.checked=false;
            document.getElementById('div_tra_'+id).style.display="none";  
            document.getElementById('tra_'+e.target.value).value="";  
            document.getElementById('des_tra_'+e.target.value).value="";  
          }
        
      });
      
     

});
</script>
<script type="text/javascript">
  function crear_anuncio(){
         
         var t=document.getElementsByName("tramites");
         var v=document.getElementsByName("valor");
         var d=document.getElementsByName("terminos");
         var tramites=[];
         var valores=[];
         var descripciones=[];
         var ubicacion=[];
         console.log(t);
         console.log(v); 
         var e=0;
         for(var i in t){
              if(t[i].id!=undefined){
                 var tram=document.getElementById("tra_"+t[i].id.split("_")[1]);
                 var des=document.getElementById("des_tra_"+t[i].id.split("_")[1]);
                 var chk=document.getElementById("ch_"+t[i].id.split("_")[1]);
                if((chk.checked == true && tram.value == "") || 
                    (chk.checked == true &&
                    des.value == "") ){
                   
                    var msn="";
                    if(tram.value=="" && des.value==""){
                      msn="No ovides agregar el valor y la descripción para cada uno de tus tramites para todos tus tramites";
                      tram.style.border="thick solid RED";
                      des.style.border="thick solid RED";
                    
                    }else if(tram.value==""){
                      msn="No ovides agregar el valor para cada uno de tus tramites para todos tus tramites";
                      tram.style.border="thick solid RED";
                    }else{
                      msn="No ovides agregar la descripción para cada uno de tus tramites para todos tus tramites";
                      des.style.border="thick solid RED";
                    
                    }



                    //document.getElementById("tra_"+t[i].id.split("_")[1]).classList.add("border border-danger");
                    //console.log(document.getElementById("tra_"+t[i].id.split("_")[1]));
                    mensaje({mensaje:msn,respuesta:false});
                    return false;
                }else if(chk.checked == true){
                  
                  if(v[i].value > 99999999999){
                    mensaje({mensaje:"El valor ingresado es demasiado alto",respuesta:false});
                    tram.style.border="thick solid RED";
                    return false;
                  }  
                  valores[e]=v[i].value;
                  tramites[e]=t[i].value;
                  descripciones[e]=d[i].value;
                  e++;
                  tram.style.border="";
                  des.style.border="";
                }
              }
              
         
              
          }  
           
            if(document.getElementById("id_ad-place").value==""){
               document.getElementById("id_ad-place").style.border="thick solid RED";
               mensaje({mensaje:"La ubicación es obligatoría",respuesta:false});
               return false;
            }else{
              var u={
                direccion:document.getElementById("id_ad-place").value,
                localidad:document.getElementById("locality").value,
                departamento:document.getElementById("administrative_area_level_1").value,
                ciudad:document.getElementById("country").value,
                cod_postal:document.getElementById("postal_code").value,
              }
              
            }
            
            if(tramites.length>0){
              var d={
                tramites:tramites,
                valores:valores,
                ubicacion:u,
                descripciones:descripciones
              }  
            }else{
              
              mensaje({mensaje:"Debes seleccionar un tramite al menos",respuesta:false})
              return false;
            } 
          

          /*
           * Envio la peticion
          */
          peticion_ajax("post","admin/anuncios",d,function(rs){
            mensaje(rs);
            if(rs.respuesta){
              document.getElementById("id_ad-place").value="";
              var tra=document.getElementsByName("tramites");
              var val=document.getElementsByName("valor");
              var ter=document.getElementsByName("terminos");
              for(var i in tra ){
                if(tra[i].checked!=false){
                  console.log(tra[i].value);
                  tra[i].checked=false;
                  ter[i].value="";
                  val[i].value="";
                  var el=document.getElementById('div_tra_'+tra[i].value);
                  document.getElementById("id_ad-place").style.border="";
                  if(el!=null){
                    el.style.display="none";    
                  }
                  
                  
                }

              }
            }
          });
        
      }
      
</script>
  @include('partials.google_directions')
@endsection
