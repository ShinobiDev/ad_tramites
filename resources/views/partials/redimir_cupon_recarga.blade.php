<div>
	<label for="valor" class="text-primary">Tienes un cupón, puedes redimirlo aquí</label>
	<input type="text" class="form-control" name="cupon" id="txt_cupon_{{$c}}" onchange="canjear_cupon(this,'{{$c}}')" placeholder="">
	<input type="hidden" name="valor_descuento_cupon" id="hd_cupon" value="0" >
	<span id="sp_espera_cupon{{$c}}"></span>
</div>
<script type="text/javascript">
	function canjear_cupon(e,id){	

		if(e.value!=""){
			mostrar_cargando("sp_espera_cupon"+id,5,"Verificando cupón ...");
			document.getElementById('btn_recarga').style.display='none';
			peticion_ajax('POST','admin/canjear_cupon_recarga',{"cupon":e.value,'usuario_que_redime':'{{auth()->user()->id}}','ref_pago':document.getElementById("refRecarga").value,'valor_pago':document.getElementById('hd_val_recarga').value,'valor_recarga':document.getElementById('num_valor_recarga').value},function(e){
					//success
				console.log(e);
				if(e.respuesta){
					document.getElementById('sp_espera_cupon'+id).innerHTML=e.mensaje;
					document.getElementById('sp_espera_cupon'+id).classList.remove('text-red');	
					document.getElementById('sp_espera_cupon'+id).classList.add('text-success');	
					document.getElementById('btn_acepta_recarga').disabled=false;
					document.getElementById("btn_recarga").style.display='none';
					//document.getElementById('num_valor_recarga').value=e.nuevo_valor;
					//document.getElementById('num_valor_recarga').min=e.nuevo_valor;
					//document.getElementById('hd_num_valor_recarga').value=e.nuevo_valor;
					document.getElementById('hd_val_recarga').value=e.nuevo_valor;
					document.getElementById("msnValorAPagar").innerHTML=number_format(e.nuevo_valor,0,',','.');  
					
					document.getElementById('hd_cupon').value=e.nuevo_valor_recarga;
					
					if(e.hash_payu!=false){
						document.getElementById('hd_signature_recarga').value=e.hash_payu;	
					}					
					
					if(e.recarga_gratis){
						document.getElementById('btn_acepta_recarga').disabled=true;
						document.getElementById('sp_valor_recarga').innerHTML=number_format(e.valor_recarga,0,',','.');
					}

					if(e.acumulable=='0'){
						document.getElementById('txt_cupon_'+id).disabled=true;
						document.getElementById('sp_espera_cupon'+id).innerHTML+=" Este cupón no es acumulable  con otras promociones"
					}
				}else{
					document.getElementById('sp_espera_cupon'+id).innerHTML=e.mensaje;
					document.getElementById('sp_espera_cupon'+id).classList.remove('text-success');	
					document.getElementById('sp_espera_cupon'+id).classList.add('text-red');
					document.getElementById('btn_acepta_recarga').disabled=true;
					document.getElementById("btn_recarga").style.display='none';
				}
				

				},function(e){
					//error
				document.getElementById('sp_espera_cupon'+id).innerHTML="Este cuṕón no es válido";
				document.getElementById('sp_espera_cupon'+id).classList.remove('text-success');	
				document.getElementById('sp_espera_cupon'+id).classList.add('text-red');
				document.getElementById('btn_acepta_recarga').disabled=true;
				document.getElementById("btn_recarga").style.display='none';
				console.log(e)
			});	
		}else{
			document.getElementById('sp_espera_cupon'+id).innerHTML="";
			document.getElementById('btn_acepta_recarga').disabled=false;
			document.getElementById("btn_recarga").style.display='none';
		}
		
	}	
</script>