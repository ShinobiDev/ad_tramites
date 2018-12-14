<div style="overflow-y: scroll; height: 450px;" >
	<form id="formTramites">
		 <div class="checkbox">	  			
  			<label><input type="checkbox" name="tramite" value="0" onchange="validar_tramite(this)" checked>Todos</label>	
  		</div>	  		
  	@foreach($tramites as $t)
  		<div class="checkbox">	  			
  			<label><input type="checkbox" name="tramite" value="{{$t->id}}" onchange="validar_tramite(this)" checked>{{$t->nombre_tramite}}</label>	
  		</div>	  		
  	@endforeach	
  	</form>
</div> 
<script type="text/javascript">
	
  /**
   * Funcion para validar si seleccionan todos o no 
   * @param  {[type]} e.value [description]
   * @return {[type]}         [description]
   */
  function validar_tramite(e){  
		if(e.value==0 && e.checked==false){
      checkear(false);
    }else if(e.value==0 && e.checked==true){
      checkear(true);
    }
		
	}
  /**
   * Funcion para checkear o quitar check de los elementos 
   * @param  {[type]} val [description]
   * @return {[type]}     [description]
   */
  function checkear(val){
    var elem=document.getElementsByName("tramite");
      for(var l in elem){
        if(elem[l].checked != val){
          elem[l].checked=val;  
        }
        
      }
  }
</script>