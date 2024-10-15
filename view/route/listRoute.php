  <?php 
  if(!isset($_SESSION['user']))header("location:". DEFAULT_ADDRESS_LOGOUT); ?>
  <main>
      <div class="header">
          <div class="left">
              <h2>Rutas</h2>
          </div>
      </div>

      <div class="bottom-data"  >
          <div >
              <div class="rift">
                  <a class="enlaces" href="index.php?controller=route&action=listRouteDisabled"
                      title="Visualizar Rutas Inhabilitadas"><button class="button-Rev2">Inhabilitados</button>
                  </a>
                  <a class="enlaces" href="index.php?controller=route&action=addRoute" title="Añadir"> <button
                          class="button-Rev2">Añadir</button>
                  </a>
              </div>


              <table id="routeTable" class="display" style="width:100%">
                  <thead >
                      <tr >
                          <th>Lugar</th>
                          <th>Ubicación</th>
                          <th>Parroquia</th>
                          <th>Municipio</th>
                          <th>Estado</th>
                          <th>Descripción</th>
                          <th>Imagen</th>
                          <th>Opciones</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php

                      if (count($dataToView["data"]) > 0) {
                          foreach ($dataToView["data"] as $data) {
                    ?>
                    <tr>
                        <td><?php echo $data['place']; ?></td>
                        <td><?php echo $data['location']; ?></td>
                          <td><?php echo $data['parroquia']; ?></td>
                          <td><?php echo $data['municipio']; ?></td>
                          <td><?php echo $data['estado']; ?></td>
                          <td><?php echo $data['description']; ?></td>
                          <td>
                              <a class="example-image-link" href="<?php echo $data['image']; ?>"
                                  data-lightbox="example-<?php echo $data['place']; ?>"
                                  data-title="<?php echo $data['place']; ?>">
                                  <img class="example-image" src="<?php echo $data['image']; ?>" alt="Imagen rutas"
                                      width="70px" height="70px" style="border-radius: 7px;" />
                              </a>
                          </td>
                          <td>
                              <a href="index.php?controller=route&action=editRoute&id=<?php echo $data['idRoute']; ?>"
                                  title="Editar">
                                  <img src="asset/icon/edit.png" width=30px>
                              </a>&nbsp&nbsp
                              <a href="index.php?controller=route&action=disableRoute&id=<?php echo $data['idRoute']; ?>&opc=false"
                                  title="Inhabilitar">
                                  <img src="asset/icon/disable.png" width=30px>
                              </a>
                          </td>
                      </tr>
                      <?php
                                  }
                                } 
                                ?>
                  </tbody>
              </table>
          </div>
      </div>
      <script src="asset\js\dataT\routeDataT.js"></script>
  </main>