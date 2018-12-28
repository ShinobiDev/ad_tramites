 <table id="users-table" class="table table-striped table-codensed table-hover table-resposive">
                <thead>
                  <tr>
                    <th>Tramite</th>
                    <th>Descripción   </th>
                    <th>Ciudad</th>
                    <th>Valor    </th>
                    @role("Admin")
                      <th>Usuario</th>
                    @endrole
                    <th>Estado anuncio</th>
                    <th>Acciones</th>
                  </tr>
                </thead>               
                <tbody id="tbbody">
                </tbody>
              </table>

                  