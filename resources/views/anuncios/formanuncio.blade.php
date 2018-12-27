<div class="container">
  <form id="ad_form" class="form-horizontal add-adform" >
    {{csrf_field()}}

            <input id="hd_tipo_anuncio" type='hidden' name='tipo_anuncio' />
            <fieldset>

             <div class="row " id="row_id_ad-place">
               
               <div class="col-md-7 two-col-help-text">
                
               </div>
             </div>
             <div class="row " id="row_id_ad-online_provider">
                {{-- <div id="div_id_ad-online_provider" class="col-md-2 label-col form-group">
                  <label for="id_ad-online_provider" class="control-label requiredField"> Forma de pago </label>
                </div>
                <div class="col-md-3">
                  <div class="controls">
                    <select class="select form-control" id="id_ad-online_provider" name="ad-online_provider">
                       <option value="NATIONAL_BANK">Transferencia bancaria nacional</option>
                    </select>
                  </div>
                </div> 
                  <div class="col-md-7 two-col-help-text">
                     <div id="online-payment-method-description" style="display: none">
                              <strong id="payment-method-name"></strong>
                                <p id="payment-method-description"></p>
                        <div id="online-sell-risk">
                          <p>
                              El riesgo asociado a la venta de criptomonedas online con esta forma de pago es <strong id="risk-level"></strong>.
                         </p>
                         <p>
                              Infórmese sobre los niveles de riesgo en
                              <a href="/guides/how-to-sell-bitcoins-online#risk-level"><i class="icon icon-info"></i> nuestra guía de venta online</a>.
                         </p>
                       </div>
                       <div id="online-buy-risk">
                         <p>
                           La compra de criptomonedas online está protegida por el depósito en garantía de <a href="/">MetalBit</a>
                         </p>
                         <p>
                           Para más información, consulte <a target="_blank" href="/security/"><i class="icon icon-info"></i> nuestra guía de seguridad</a>.
                         </p>
                     </div>
                    </div>
                  </div>--}}
             </div>
            </fieldset>

            <fieldset>
              
              <div class="row">
                 <div id="div_id_ad-place" class="col-md-4 label-col form-group">
                    <label for="id_ad-place" class="control-label requiredField"> Ciudad donde se realizan los tramites </label>
                     
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
                  <legend>Tramites</legend>
                  <div class="col-md-16 form-group">
                                        
                      @include('anuncios.btns_tramites')
                     
                  </div>
                 
                 
                 
              </div>
              
                                
            </fieldset>



                 <hr>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id }}" class="form-control">
                    <div class="form-group col-sm-4"> <div class="controls ">
                       <input type="button" name="submit" value="Publicar anuncio" class="btn btn-success" id="btn_crear_anuncio" onclick="crear_anuncio()" />
                       <!--<button class="btn btn-success" id="btn_crear_anuncio">
                          Publicar anuncio
                       </button> -->
                    </div>
                    </div>

  </form>
</div>