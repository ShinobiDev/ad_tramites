<!--anuncios-->
{{--dd($anuncios)--}} 

<div class="container-fluid">
 <div class="col-md-12 col-lg-offset-0">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Encuentra tu Tramitador</h3>
            @guest
              <div class="d-flex">
                <a href="{{route('login')}}" class="btn btn-primary pull-right btn-lg" >
                  <i class="fa fa-user-plus"> Crear Anuncio</i>
                </a>
                 <a href="{{config('app.url')}}" class="btn btn-success pull-right btn-lg" >
                    <i class="fa "> Ver más anuncios</i>
                 </a>
                 <a href="/" class="btn btn-default pull-right btn-lg" >
                    <i class="fa "> Reiniciar busqueda</i>
                 </a>  
              </div>
              
              @else 
               <div class="d-flex">
                <a href="{{route('anuncios.create')}}" class="btn btn-primary pull-right btn-lg" >
                    <i class="fa fa-user-plus"> Crear Anuncio</i>
                </a>
                
                <a href="{{config('app.url')}}" class="btn btn-success pull-right btn-lg" >
                    <i class="fa "> Ver más anuncios</i>
                </a>
                
                <a href="/" class="btn btn-default pull-right btn-lg" >
                    <i class="fa "> Reiniciar busqueda</i>
                </a>
              </div>  
              @endguest 

      </div>
      <div class="box-body"> 
         
      
              @include('partials.alert')
              @include('anuncios.tabla_anuncios')              
      
      </div>



    </div>


 </div>
</div>
<!--anuncios-->


  