<div class="container">
  <form id="ad_form" class="form-horizontal add-adform" >
    {{csrf_field()}}

            <input id="hd_tipo_anuncio" type='hidden' name='tipo_anuncio' />
            <fieldset>

             <div class="row " id="row_id_ad-place">

               <div class="col-md-7 two-col-help-text">

               </div>
             </div>
             
            </fieldset>

            <fieldset>

              <div class="row">
                 <div id="div_id_ad-place" class="col-md-4 label-col form-group">
                    <label for="id_ad-place" class="control-label requiredField"> Ciudad donde se realizan los trámites </label>

                 </div>
                 <div class="col-md-3">
                   <div class="controls">
                    <input class="textinput textInput form-control" id="id_ad-place" name="ubicacion" type="text" required/>
                     <input type="hidden" id="locality" name="localidad">
                     <input type="hidden" id="administrative_area_level_1" name="departamento">
                     <input type="hidden" id="country" name="ciudad">
                     <input type="hidden" id="postal_code" name="cod_postal" >
                   </div>
                 </div>
              </div>
              <div class="row " id="row_id_ad-currency">
                  <legend>Trámites</legend>
                  <div class="col-md-16 form-group">

                      @include('anuncios.btns_tramites')

                  </div>



              </div>


            </fieldset>



                 <hr>
                    <input type="hidden" name="user_id" value="{{auth::user()->id }}" class="form-control">
                    <div class="form-group col-sm-4">
                      <div class="controls">
                         <input type="button" name="submit" value="Publicar anuncio" class="btn btn-success" id="btn_crear_anuncio" onclick="crear_anuncio()" />
                         <h5 id="h5Espera" ></h5>
                         <!--<button class="btn btn-success" id="btn_crear_anuncio">
                            Publicar anuncio
                         </button> -->
                     </div>
                    </div>

  </form>
</div>
