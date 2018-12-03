<!--ventas-->

<div class="container-fluid">
 <div class="col-md-12 col-lg-offset-0">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Listados de mis anuncios </h3>
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

      <div class="row">
          <div class="box-body col-sm-2">
            @include('anuncios.filtro_tramites_mis_anuncios')
          </div>  
          <div class="box-body col-sm-10">
            @include('partials.alert')
            <table id="users-table" class="table table-striped table-codensed table-hover table-resposive">
                <thead>
                  <tr>
                    <th>Tramite</th>
                    <th>Descripción</th>
                    <th>Ciudad</th>
                    <th>Valor</th>
                    <th>Estado anuncio</th>
                    <th>Acciones</th>
                  </tr>
                </thead>               
                <tbody id="tbbody">
                  @include('anuncios.tabla_mis_anuncios')
                </tbody>
              </table>
          </div>
      </div>


    </div>


 </div>
</div> 
<!--ventas-->

