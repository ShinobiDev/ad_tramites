
@foreach($tramites as $t)
<div class="col-md-3 label-col form-group">
    
    
    <div class="col-md-10">
    	<input id="ch_{{$t->id}}" type="checkbox" name="tramites" value="{{$t->id}}">
    	<label name="lbl_tramite" id="lbl_{{$t->id}}" class="label-col">{{$t->nombre_tramite}}</label>
    	
        <div id="div_tra_{{$t->id}}" class="controls" style="display: none;">
        	<input id="tra_{{$t->id}}"  class="textinput textInput form-control"  name="valor" type="number" placeholder="Valor del servicio"/>
            <textarea id="des_tra_{{$t->id}}" class="textarea form-control" cols="20" id="id_ad-other_info" name="terminos" rows="10" placeholder="Escriba la descripción del anuncio aquí" maxlength="110" ></textarea>
        </div>
    </div>
   
</div>
@endforeach
