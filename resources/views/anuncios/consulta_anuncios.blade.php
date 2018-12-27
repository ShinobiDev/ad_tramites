<!--anuncios-->
{{--dd($anuncios)--}} 

<div class="container-fluid">
 <div class="col-md-12 col-lg-offset-0">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Listados De Anuncios De Venta</h3>
            @guest
              <a href="{{route('login')}}" class="btn btn-primary pull-right btn-lg" >
                  <i class="fa fa-user-plus"> Crear Anuncio</i>
              </a>
              @else 
               <a href="{{route('anuncios.create')}}" class="btn btn-primary pull-right btn-lg" >
                  <i class="fa fa-user-plus"> Crear Anuncio</i>
              </a>
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


  