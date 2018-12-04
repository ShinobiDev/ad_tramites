<div style="overflow-y: scroll; height: 450px;" >
	<form id="formTramites">
		 <div class="checkbox">	  			
  			<label><input type="checkbox" name="tramite" value="0" onchange="validar_tramite(this)">Todos</label>	
  		</div>	  		
  	@foreach($tramites as $t)
  		<div class="checkbox">	  			
  			<label><input type="checkbox" name="tramite" value="{{$t->id}}" onchange="validar_tramite(this)">{{$t->nombre_tramite}}</label>	
  		</div>	  		
  	@endforeach	
  	</form>
</div> 
<script type="text/javascript">
	function validar_tramite(e){
		alert(":P"+e.value);
		
	}
</script>