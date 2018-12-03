<form method="POST" action="{{url('calificar')}}">
                            {{csrf_field()}}
	<input type="hidden" name="id_transaccion" value="{{$transaccion->id}}">
    <section class="clasificacion">
    	<input id="rd1" class="" type="radio" name="nota" value="1">
    	<label for="rd1">1</label>
    	<input id="rd2" class="" type="radio" name="nota" value="2">
    	<label for="rd2">2</label>
    	<input id="rd3" class="" type="radio" name="nota" value="3">
    	<label for="rd3">3</label>
    	<input id="rd4" class="" type="radio" name="nota" value="4">
    	<label for="rd4">4</label>
    	<input id="rd5" class="" type="radio" name="nota" value="5">
    	<label for="rd5">5</label>
    	
    </section>  
    <section>
        <h1>Opinión</h1>
        <select name="sel_opt_calificacion">
            <option value="Nunca contesto"></option>
            <option value="Recomendadisimo"></option>
            <option value="POsible fraude"></option>
            <option value="Excelente atención"></option>
            <option value="Transaccion Efectiva y segura"></option>
            <option value="La atención no fue tan buena"></option>
            <option value="Usuario no fue puntual con transacción"></option>
            <option value="Otros"></option>
        </select>
    </section>     
    <div class="modal-body">
    <textarea max="110" class="textarea form-control" name="opinion" placeholder="Dejanos conocer tu opinión"
     onkeypress="validar_tam_txt()">
    </textarea >
    <label>Por favor trata de ser breve y claro con tu opinión para ayudar a otros usuarios a conocer y hacer mejor uso de {{config('app.name')}}</label>
    <label ><span id="lb_limit_txt">0</span> de 110 caracteres permitidos</label>                 
	
    </div>	
    <button id="btn_recarga" type="submit" class="btn btn-primary">Calificar</button>
</form>
<script type="text/javascript">
       /**
        * Funcion para validar el tamaño limite de el texto
        * @param  {[type]} e [elemento que desencadena el evento]
        * @return {[void]}   [realiza el cambio de la variable lb_limit_txt]
        */
       function validar_tam_txt(e){
            //console.log(e.value);
            //console.log(e.value.length);
            //document.getElementById('lb_limit_txt').innerHTML=e.value.length;
       } 
</script>