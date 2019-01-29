<!--ventas-->

<div class="container-fluid">
 <div class="col-md-12 col-lg-offset-0">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Mis anuncios</h3>
            @guest
              <a href="{{route('login')}}" class="btn btn-primary pull-right btn-lg" >
                  <i class="fa fa-user-plus"> Crear un anuncio</i>
              </a>
              @else 
               <a href="{{route('anuncios.create')}}" class="btn btn-primary pull-right btn-lg" >
                  <i class="fa fa-user-plus"> Crear un anuncio</i>
              </a>
              @endguest 

      </div>

      <div class="box-body">
          
          
           @include('partials.alert')
           @include('anuncios.tabla_mis_anuncios')
          
      </div>


    </div>


 </div>
</div> 
<!--ventas-->

