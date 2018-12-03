@extends('layouts.app')

@section('head')
  {{-- content --}}
@endsection


@section('content')
      <body class="server-prod session-anonymous">
        <div class="container">
          <h1>Cree un anuncio para ofertar tramites</h1>


          <h3>Normas y requisitos de anuncios</h2>

            <p>
              <ul>
                    {{--
                    <li>Determinados métodos de pago requieren tener la identificación verificada antes de hacer visibles los anuncios.</li>
                    <li>Cada operación completada cuesta a los anunciantes un 1% del importe total de la operación.
                      <!--<a href="/fees">Vea la lista de todas las comisiones en la página Comisiones</a>.-->
                    </li>
                    <li>
                        Una vez abierta una operación, el precio no se puede cambiar, excepto los casos en los que hay un error evidente en el precio.
                    </li>
                    <li>
                          No se permite comprar ni vender criptomendas en nombre de otras personas (correduría).
                    </li>
                    <li>
                          Solo puede usar cuentas de pago registradas a su propio nombre (¡no se aceptan pagos de terceros!).</li> <li>Debe especificar sus datos de pago en el anuncio o en el chat de la operación.
                     </li>
                     <li>
                            Todas las comunicaciones se deben llevar a cabo en <a href="/">MetalBit</a>.
                     </li>
                      <li>
                              Los métodos de pago marcados con la etiqueta <strong>Alto riesgo</strong> suponen un <strong>riesgo significante de fraude</strong>. Tenga cuidado y siempre verifique la identidad de sus socios en las operaciones al utilizar los métodos de pago de alto riesgo.
                      </li>--}}
              </ul>
            </p>
              <br>

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

              </div>
            </div>

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
          @include('partials.alert')
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
                console.log(document.getElementById("tra_"+t[i].id.split("_")[1]).value);
                if(document.getElementById("tra_"+t[i].id.split("_")[1]).value == "" && document.getElementById("ch_"+t[i].id.split("_")[1]).checked == true && document.getElementById("des_tra_"+t[i].id.split("_")[1]).value == ""){
                    document.getElementById("tra_"+t[i].id.split("_")[1]).style.border="thick solid #FFFFF";
                    
                    //document.getElementById("tra_"+t[i].id.split("_")[1]).classList.add("border border-danger");
                    console.log(document.getElementById("tra_"+t[i].id.split("_")[1]));
                    mensaje({mensaje:"No ovides agregar el valor para todos tus tramites",respuesta:false});
                    return false;
                }else if(document.getElementById("ch_"+t[i].id.split("_")[1]).checked == true){
                  tramites[e]=t[i].value;
                  valores[e]=v[i].value;
                  descripciones[e]=d[i].value;
                  e++;
                }
              }
              
         
              
          }  
           
            if(document.getElementById("id_ad-place").value==""){
               
               mensaje({mensaje:"La ubicación es obligatoría",respuesta:false});
               return false;
            }else{
              var u={
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
          
          peticion_ajax("post","admin/anuncios",d,function(rs){
            mensaje(rs);
            if(rs.respuesta){
              document.getElementById("id_ad-place").value="";
              var tr=document.getElementsByName("tramites");
              var v=document.getElementsByName("valor");
              for(var t in tr ){
                if(tr[t].checked!=false){
                  tr[t].checked=false;
                  v[t].value="";
                  d[t].value="";
                }

              }
            }
          });
        
      }
      
</script>
@include('partials.google_directions')




@endsection
