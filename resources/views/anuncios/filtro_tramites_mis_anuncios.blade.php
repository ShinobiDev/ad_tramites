<div>
  	<h3 class="box-title">Tramites </h3>
  	@include('partials.lista_tramites')
	@guest
	  <a href="{{route('login')}}" class="btn btn-success" >
	      Buscar
	  </a>
	@else 
	   
	   <input class="btn btn-success" onclick="buscar_anuncios('mis_anuncios')" value="Buscar" type="submit" />
	@endguest 
	

</div>	
