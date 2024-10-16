<main>
      <div class="header">
          <div class="left">
              <h2>Ofertas de viaje</h2>
          </div>
      </div>

      <div class="bottom-data">
          <div>
              <div class="rift">
                  <a class="enlaces" href="index.php?controller=trip&action=addTrip" title="Añadir"><button
                          class="button-Rev2">Añadir</button>
                  </a>
                  <a class="enlaces" href="index.php?controller=trip&action=listTripDisabled"
                      title="Visualizar Rutas Inhabilitadas"><button class="button-Rev2">Inhabilitados</button>
                  </a>
              </div>


              <table id="tripTable" class="display" style="width:100%">
                  <thead>
                      <tr>
                        <th>conteo</th>
                          <th>Título</th>
                          <th>Lugar de destino</th>
                          <th>Paquete</th>
                          <th>Precio</th>
                          <th>Lugar de salida</th>
                          <th>Fecha de salida</th>
                          <th>Hora de salida</th>
                          <th>Fecha de retorno</th>
                          <th>Hora de retorno</th>
                          <th>Numero de cupos</th>
                          <th>Parroquia</th>
                          <th>Municipio</th>
                          <th>Estado</th>
                          <th>Opciones</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                     if (count($dataToView["data"]) > 0) {
                        foreach ($dataToView["data"] as $data) {
                    ?>
                        <tr>
                            <td><?php echo $data['tripCount']; ?></td>
                            <td><?php echo $data['titleTrip']; ?></td>
                            <td><?php echo $data['place']; ?></td>
                            <td><?php echo $data['titlePackages']; ?></td>
                            <td><?php echo $data['amount']; ?></td>
                            <td><?php echo $data['departureLocation']; ?></td>
                            <td><?php echo $data['departureDate']; ?></td>
                            <td><?php echo $data['departureTime']; ?></td>
                            <td><?php echo $data['returnDate']; ?></td>
                            <td><?php echo $data['returnTime']; ?></td>
                            <td><?php echo $data['numberSlots']; ?></td>
                            <td><?php echo $data['parroquiaName']; ?></td>
                            <td><?php echo $data['municipio']; ?></td>
                            <td><?php echo $data['estado']; ?></td>
                   
                        <td>
                            <a href="index.php?controller=trip&action=editTrip&id=<?php echo $data['idTrip']; ?>"
                                title="Editar">
                                <img src="asset/icon/edit.png" width=30px>
                            </a>&nbsp&nbsp
                             <a href="index.php?controller=trip&action=disableTrip&id=<?php echo $data['idTrip'];?>&opc=false"
                                title="Cancelar">
                                <img src="asset/icon/quitar.png" width=30px>
                            </a>
                        </td>

                        <?php
                            }
                          } 
                        ?>
                      </tr>
                             
                  </tbody>
              </table>
          </div>
      </div>
      <script src="asset/js/dataT/travelOfferDataT.js"></script>
  </main>