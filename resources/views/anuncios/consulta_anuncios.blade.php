<!--anuncios-->
{{--dd($anuncios)--}} 

<div class="container">
 <div class="col-lg-12 col-12 col-md-12">
    <div class="box box-primary">
      <div class="col-lg-12 col-12 col-md-12 box-header">
              <div class="col-lg-4 col-4 col-md-2" >
                  <h3 class="box-title">Encuentra tu Tramitador</h3>
              </div>
            @guest
              
              <div class="col-lg-8 col-8 col-md-8" >
                <div class="col-4 col-md-4">
                  <a href="{{route('login')}}" class="btn btn-primary pull-right btn-lg  btn-block" >
                  <i class="fa fa-user-plus">Crea un anuncio</i>
                  </a>
                  
                </div>
                <div class="col-4 col-md-4">
                  <a href="{{config('app.url')}}" class="btn btn-success pull-right btn-lg  btn-block" >
                    <i class="fa ">Ver más anuncios</i>
                 </a>
                  
                </div>
                 <div class="col-4 col-md-4">
                   <a href="/" class="btn btn-default pull-right btn-lg  btn-block" >
                    <i class="fa ">Reiniciar busqueda</i>
                  </a>
                 </div>  
              </div>
              
              @else 
              <div class="col-lg-8 col-8 col-md-10" >
                <div class="col-md-4">
                  <a href="{{route('anuncios.create')}}" class="btn btn-primary pull-right btn-lg btn-block" >
                    <i class="fa fa-user-plus">Crea un anuncio</i>
                  </a>
                </div>                  
                <div class="col-md-4">
                  <a href="{{config('app.url')}}" class="btn btn-success pull-right btn-lg btn-block" >
                    <i class="fa ">Ver más anuncios</i>
                  </a>                
                </div>  
                <div class="col-md-4">
                  <a href="/" class="btn btn-default pull-right btn-lg btn-block" >
                    <i class="fa ">Reiniciar busqueda</i>
                </a>
                </div>  
                
              </div>  
              @endguest 

      </div>
      <div class="col-12 col-md-12 box-body"> 
         
      
              @include('partials.alert')
              @include('anuncios.tabla_anuncios')              
      
      </div>



    </div>


 </div>
</div>
<script type="text/javascript">
  window.onload=function(){
    var ss=sessionStorage.getItem('fila');
    if(ss!=null){
      document.getElementById("row_"+ss).style.backgroundColor='#d9e3f1'; 
      document.getElementById("row_"+ss).classList.add('fondo_fila');
    }
  }

 function donde_estoy(id){
   document.getElementById("row_"+id).classList.add('fondo_fila');
    
   sessionStorage.setItem('fila', id);
   console.log(document.getElementById("row_"+id));
   var ele=document.querySelectorAll(".fondo_fila");
   console.log(ele.length);
   if(ele.length>1){
    for(var i = 0;i <= ele.length-1;i++){
      ele[i].classList.remove('fondo_fila');
      document.getElementById(ele[i].id).style.backgroundColor='#f9f9f9';
      if(document.getElementById(ele[i].id) != null){          
          document.getElementById("row_"+id).classList.add('fondo_fila');
          document.getElementById("row_"+id).style.backgroundColor='#d9e3f1'; 
      }
    }
      
   
   }else{
    document.getElementById("row_"+id).style.backgroundColor='#d9e3f1'; 
   }
   


 }      
  
</script>
<!--anuncios-->


  