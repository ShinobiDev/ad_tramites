@extends('layouts.app')

@section('head')
  {{-- content --}}
@endsection


@section('content')
      <body class="server-prod session-anonymous">
        <div class="container">
          <h1 class="text-center">Crea un anuncio para ofertar trámites</h1>



            <div class="row container">



              <div id="identification_hint" class="col-md-12 display-none">
                <h2 class="text-center text-red">Normas y requisitos de los anuncios</h2>

                  <noscript>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="alert alert-danger">
                                  Debe activar JavaScript para poder completar este formulario.
                              </div>
                          </div>
                      </div>
                  </noscript>

                <h4>
                  Para que tus anuncios sean visibles, debes tener saldo en la cuenta de recarga.
                  Recuerda que cada click de tu anuncio tiene un valor de: <span class="text-red">$</span> <span class="text-primary">{{number_format(Auth()->user()->costo_clic,0,"",".")}} COP.</span> 
                </h4>
                <h4>BALANCE DE RECARGA: <span class="text-red">$</span> <span class="text-primary"> {{number_format(auth()->user()->valor_recarga,0,"",".")}} COP</span> </h4>
                <div class="alert alert-info">

                    <h3>
                      <i class="fa fa-info-circle"></i>
                      <span class="text-red">¿Quieres aumentar tu visibilidad?</span>, los anuncios son ordenados orgánicamente situando primero a los usuarios que tengan un mayor valor de recarga total.
                    </h3>

                </div>
                <div class="alert alert-warning">
                    <h3>
                      <i class="fa fa-info-circle"></i>
                      Si tu servicio es comprado directamente en <a href="{{config('app.url')}}"><span class="text-primary">{{config('app.name')}}</span></a>, el costo de este servicio es del <span class="text-primary">{{$porcentaje[0]->valor}}</span><span class="text-red">%</span>.
                    </h3>
               </div>           
              </div>
            </div>

            <legend class="text-center text-primary">Crea un anuncio</legend>
            <div class="row " id="">
                <div id="" class="col-md-2 label-col form-group">
           
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
                      msn="No olvides agregar el valor y la descripción para cada uno de tus trámites.";
                      tram.style.border="thick solid RED";
                      des.style.border="thick solid RED";
                      window.scrollTo(0, 0);


                    }else if(tram.value==""){
                      msn="No ovides agregar el valor para cada uno de tus trámites.";
                      tram.style.border="thick solid RED";
                      window.scrollTo(0, 0);
                    }else{
                      msn="No ovides agregar la descripción para cada uno de tus trámites.";
                      des.style.border="thick solid RED";
                      window.scrollTo(0, 0);

                    }

                  if(Number(tram.value) < 10000 ){
                      msn="El valor mínimo de el trámite es de $10.000.";
                      tram.style.border="thick solid RED";
                      window.scrollTo(0, 0);
                  
                  }



                    //document.getElementById("tra_"+t[i].id.split("_")[1]).classList.add("border border-danger");
                    //console.log(document.getElementById("tra_"+t[i].id.split("_")[1]));
                    mensaje({mensaje:msn,respuesta:false},'Alert');
                    return false;
                }else if(chk.checked == true){

                  if(v[i].value > 99999999999){
                    mensaje({mensaje:"El valor ingresado es demasiado alto",respuesta:false});
                    tram.style.border="thick solid RED";
                    window.scrollTo(0, 0);
                    return false;
                  }
                  if(Number(v[i].value) < 10000 ){
                      msn="El valor mínimo del trámite es de $10.000.";
                      mensaje({mensaje:msn,respuesta:false});
                      
                      tram.style.border="thick solid RED";
                      window.scrollTo(0, 0);
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
               mensaje({mensaje:"La ubicación es obligatoría",respuesta:false},'Alert');
               window.scrollTo(0, 0);
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

              mensaje({mensaje:"Debes seleccionar un trámite al menos.",respuesta:false},'Alert');
              window.scrollTo(0, 0);
              return false;
            }


          /*
           * Envio la peticion
          */
          mostrar_cargando('h5Espera',10,"Creando anuncios ...");
          document.getElementById('btn_crear_anuncio').disabled=true;
          peticion_ajax("post","admin/anuncios",d,function(rs){

            if(rs.respuesta){
              if(rs.cambio_rol==true){
                //location.reload();
              }
              mensaje(rs,'Success');

              document.getElementById('h5Espera').style.display='none';
              document.getElementById('btn_crear_anuncio').disabled=false;
              window.scrollTo(0, 0);
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
            }else{
              mensaje(rs,'Alert');
              document.getElementById('btn_crear_anuncio').disabled=false;
            }
          });

      }

</script>
  @include('partials.google_directions')
@endsection
