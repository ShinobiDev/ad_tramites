
@foreach($tramites as $t)
<div class="col-md-4 label-col form-group">

    <div class="col-md-18" style="margin: 5px">
      <div class="input-group-text" style="margin: 10px">
        <input id="ch_{{$t->id}}" type="checkbox" name="tramites" value="{{$t->id}}">
      	<label name="lbl_tramite" id="lbl_{{$t->id}}" class="label-col small text-center">{{$t->nombre_tramite}}</label>
      </div>

        <div id="div_tra_{{$t->id}}" class="controls" style=" margin-left: 10px; display: none;">
        	<input id="tra_{{$t->id}}"  class="textinput textInput form-control" min="10000"  name="valor" type="number" placeholder="Valor del servicio"/>
            <textarea id="des_tra_{{$t->id}}" class="textarea form-control" cols="20" id="id_ad-other_info" name="terminos" rows="10" placeholder="Escriba la descripción del anuncio aquí" maxlength="110" ></textarea>
        </div>
    </div>

</div>
@endforeach
