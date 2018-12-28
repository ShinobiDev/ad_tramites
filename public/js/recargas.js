var nuevo_valor_recarga=50;

function descontar_recargar(id_ventana,id_anuncio,costo,tipo){
	
 
	console.log(document.getElementById(id_ventana));
	   $("#"+id_ventana).addClass( "in" );
	 	console.log(document.getElementById(id_ventana));
	   $("#"+id_ventana).css({"display": "block", "padding-right": "21px"});
       $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
       if(tipo!=false){

       		$.ajax({
		         type: "GET",
		         url: url_global+"admin/descontar_recargas/"+id_anuncio+"/"+costo+"/"+user_id.value+"/"+tipo,
		         dataType: "json",
		         success: function(result){
		          console.log(result);
		         if(result.ad_visible==false){
		         	
		         	$("#btn_"+id_anuncio).css({"display":"none"});	
		         }

		         if(document.getElementById("an_"+id_anuncio)!=null && tipo=="info"){
		         		$("#btn_"+id_anuncio).css({"display":"none"});	
		         		$("#an_"+id_anuncio).css({"display":""});	
		         	}
		          
		             
		         },
		     error: function(err){
		         console.log(err);
		     }
		     });
       }
		 	  	
}

function mostrar_ventana_login(id_ventana,id_anuncio,costo){
	$("#"+id_ventana).css({"display": "block", "padding-right": "21px"});
}

function salir_modal(id){
	$("#"+id).removeClass( "in" );
  	$("#"+id).css({"display": "none"});	
}
$( "#btn_sin_recarga, #sp_salir_sin_recarga" ).click(function(){
  // Holds the product ID of the clicked element
  
  
});