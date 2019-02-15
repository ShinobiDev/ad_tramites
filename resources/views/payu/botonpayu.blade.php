<div>
  <input   name="merchantId"    type="text"   value="{{trim($ad->merchantId)}}"   >
  <input name="accountId"     type="text"   value="{{trim($ad->accountId)}}" >
  <input id="hd_description_{{$ad->id}}" name="description"   type="text"   value="{{trim($ad->descripcion)}}"  >
  <input id="referenceCode{{$ad->id}}" name="referenceCode" type="text"   value="{{$ad->cod_anuncio}}" >

  
    <input id="hd_valor_venta_{{$ad->id}}" name="amount"        type="text"   value="{{$ad->valor_tramite}}" >
    <input id="currency_{{$ad->id}}" name="currency"     type="text"   value="COP" >
  
  
  <input name="tax"           type="text"   value="0"  >
  <input name="taxReturnBase" type="text"   value="0" >
  <input id="hd_signature_{{$ad->id}}" name="signature"     type="text"   value="{{trim($ad->hash)}}"  >
  <input name="buyerEmail"    type="text"   value="{{trim(Auth::user()->email)}}" >
  <input name="responseUrl"    type="text"   value="{{config('app.url').trim($ad->resp)}}" >
  <input name="confirmationUrl"    type="text"   value="{{config('app.url').trim($ad->conf)}}" >
  <input id="btn_comprar_{{$ad->id}}" type="submit" name="submit" value="COMPRAR" class="btn btn-success">
</div>
                                                                