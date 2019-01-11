<div class="modal fade" id="{{'infocalificar'.$ad->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;" >
<div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header bg-primary">
        <h3 style="text-align: center;" class="modal-title" id="exampleModalLabel"><b>Califica al anunciante</b></h3>
        <h4 class="modal-title" id="exampleModalLabel">{{config('app.name','') }}, te sirve de intermediario para garantizar que tu tramites cumplan de manerta exitosa para ambas partes, por favor dejanos conocer comentarios sobre este anunciante</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="salir_modal('{{'infocalificar'.$ad->id}}')">
          <span aria-hidden="true" >&times;</span>
        </button>
      </div>



      <div class="modal-body">
        <h4>Calificación del anunciante: </h4>
          @for($i=1;$i<=$ad->calificacion;$i++)
            @if($i<=5)
         <img  class="star" src="{{asset('img/star.png')}}">
              @endif
          @endfor
      </div>
      <div class="modal-body">
        <h6>Visto por última vez {{$ad->visto}}</h6>
      </div>
       <div class="modal-body">

            <!--<form method="POST" action="{{url('admin/calificar')}}">-->
                    <form id="formCalificar">
                     <h3 style="text-align: center;" class="modal-title" id="exampleModalLabel"><b>¿Cómo calificarias a este anunciante?</b></h3>
                    {{csrf_field()}}
                    <input type="hidden" name="id_anuncio_calificar" value="{{$ad->id_detalle_clic}}">
                    <section class="clasificacion"style="text-align: center;" value="{{old('nota')}}"  required>
                        <input id="rd1" class="" type="radio" name="nota" value="1">
                        <label for="rd1">1</label>
                        <input id="rd2" class="" type="radio" name="nota" value="2">
                        <label for="rd2">2</label>
                        <input id="rd3" class="" type="radio" name="nota" value="3">
                        <label for="rd3">3</label>
                        <!--<input id="rd4" class="" type="radio" name="nota" value="4">
                        <label for="rd4">4</label>
                        <input id="rd5" class="" type="radio" name="nota" value="5">
                        <label for="rd5">5</label>-->

                    </section>
                    <section style="text-align: center;" >
                        <h3><b>Opinión</b></h3>
                        <select id="sel_opt_calificacion{{$ad->id}}" name="opinion" class="select form-control" value="{{old('sel_opt_calificacion')}}" onchange="validar_opcion({{$ad->id}})" required>
                            <option value="0">--selecciona una opción--</option>  
                            <option value="Recomendadísimo" >Recomendadísimo</option>
                            <option value="Excelente atención" >Excelente atención</option>
                            <option value="Transacción Efectiva y segura" >Transacción Efectiva y segura</option>
                            <option value="Usuario no fue puntual con transacción" >Usuario no fue puntual con transacción</option>
                            <option value="Nunca contestó" > Nunca contestó</option>
                            <option value="Posible fraude" >Posible fraude</option>
                            <option value="La atención no fue tan buena" >La atención no fue tan buena</option>
                            <option value="Otros" >Otros</option>
                        </select>
                        <!--<input type="text" id="opinion_otro" name="opinion_otro" class="textinput textInput form-control" placeholder="Dejanos conocer tu opinión" style="display: none;">-->
                    </section>
                    <div class="modal-body">
                    <textarea  style="display: none" maxlength="110" id="txt_opinion{{$ad->id}}" class="textarea form-control" name="opinion_txt" value="{{old('opinion')}}" placeholder="Dejanos conocer tu opinión" onkeypress="validar_tam_txt(this)">
                    </textarea >
                    <h6>Por favor trata de ser breve y claro con tu opinión para ayudar a otros usuarios a conocer y hacer mejor uso de {{config('app.name')}}</h6>
                    <h6 ><span id="lb_limit_txt">0</span> de 110 caracteres permitidos</h6>

                    </div>
                    <!--<button id="btn_calificar" type="submit" class="btn btn-primary">Calificar</button>-->
                    <input type="button" value="Calificar" class="btn btn-primary" onclick="calificar_anunciante('{{$ad->id}}')">
            </form>


       </div>

        <div class="modal-footer">
        <button  type="button" class="btn btn-primary" data-dismiss="modal" onclick="salir_modal('{{'infocalificar'.$ad->id}}')">VER MÁS ANUNCIOS</button>
      </div>

    </div>
</div>
</div>
 <script type="text/javascript">
                   /**
                    * Funcion para validar el tamaño limite de el texto
                    * @param  {[type]} e [elemento que desencadena el evento]
                    * @return {[void]}   [realiza el cambio de la variable lb_limit_txt]
                    */
                   function validar_tam_txt(e){
                        console.log(e.value);
                        console.log(e.value.length);
                        if((e.value.length+1)<=110){
                            document.getElementById('lb_limit_txt').innerHTML=e.value.length+1;

                        }

                   }

                   function validar_opcion(e){
                      var sel=document.getElementById("sel_opt_calificacion"+e).value;
                     //alert(sel);
                      if(sel=="Otros"){
                        document.getElementById("txt_opinion"+e).style.display='';

                      }else{
                        document.getElementById("txt_opinion"+e).style.display='none';
                      }
                   }

                  function calificar_anunciante(id_modal){
                      form=$("#formCalificar").serializarFormulario();
                      /*
                       * Envio la peticion
                      */
                     console.log(form);
                     if(form==false){
                        mensaje({mensaje:"Debe diligenciar todos los campos ",respuesta:false});
                        salir_modal('infocalificar'+id_modal);
                        window.scrollTo(0, 0);
                        return false;
                     }else if(form.nota==undefined){
                        mensaje({mensaje:"Debes seleccionar una nota",respuesta:false});
                        salir_modal('infocalificar'+id_modal);
                        window.scrollTo(0, 0);
                        return false;
                     }
                     if(form.opinion=="0" || form.opinion==""){
                        mensaje({mensaje:"Debes seleccionar una opción",respuesta:false});
                        salir_modal('infocalificar'+id_modal);
                        window.scrollTo(0, 0);
                        return false;
                     }

                     if(form.opinion=="Otros"){
                        form.opinion=form.opinion_txt;
                     }

                     //console.log(form);
                      peticion_ajax("post","admin/calificar",form,function(rs){
                        mensaje(rs);
                        salir_modal('infocalificar'+id_modal);
                        document.getElementById("btn_cal_"+id_modal).style.display='none';
                        window.scrollTo(0, 0);
                      });

                  }

</script>
