<script type="text/javascript">
   window.onload=function(){
     consultar_datos_formulario();
   };
function consultar_datos_formulario() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {       
       cargar_selects(JSON.parse(this.responseText));
    }

  };
  xhttp.open("GET", "http://tutramitador.com/core/datos_filtro", true);
  xhttp.send();
}

function cargar_selects(datos){
  
 var selCiudades= document.getElementById('ciudadID');
 var selTramites= document.getElementById('tramiteID');

 selTramites.innerHTML="";
 var opt  = document.createElement('option');
 opt.value="0";
 opt.innerHTML="Selecciona un trámite";
 selTramites.appendChild(opt);
 for(var t in datos.tramites){
   var opt  = document.createElement('option');
   opt.value=datos.tramites[t].nombre_tramite;
   opt.innerHTML=datos.tramites[t].nombre_tramite;
   selTramites.appendChild(opt);
 }
  selCiudades.innerHTML="";
 var opt  = document.createElement('option');
 opt.value="0";
 opt.innerHTML="Selecciona una ciudad"; 
 selCiudades.appendChild(opt);
 for(var c in datos.ciudades){
   var opt  = document.createElement('option');
   opt.value=datos.ciudades[c].ciudad;
   opt.innerHTML=datos.ciudades[c].ciudad;
   selCiudades.appendChild(opt);
 }

}
</script>