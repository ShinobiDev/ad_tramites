<div>
  	<h3 class="box-title">Tramites </h3>
  	<div style="overflow-y: scroll; height: 450px;" >
  		<form id="formTramites">
  			<div class="checkbox">	  			
	  			<label><input type="checkbox" name="tramite" value="0">Todos</label>	
	  		</div>	  		
	  	@foreach($tramites as $t)
	  		<div class="checkbox">	  			
	  			<label><input type="checkbox" name="tramite" value="{{$t->id}}">{{$t->nombre_tramite}}</label>	
	  		</div>	  		
	  	@endforeach	
	  	</form>
	</div> 
	@guest
	  <a href="{{route('login')}}" class="btn btn-success" >
	      Buscar
	  </a>
	@else 
	   <input class="btn btn-success" onclick="buscar_anuncios('anuncios')" value="Buscar" type="submit" />
	@endguest 
	

</div>	

