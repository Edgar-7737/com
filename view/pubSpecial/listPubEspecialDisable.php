<?php  if(!isset($_SESSION['user'])) header("location: ".DEFAULT_ADDRESS_LOGOUT); ?>

           
                <main>
                    <div class="header">
                        <div class="left"><h2>Publicaciones Especiales Inhabilitadas</h2></div>
                    </div>
            
                    <div class="bottom-data">
                        <div >
                        <div class="left">
                            <a class="enlaces" href="index.php?controller=pubEspecial&action=list" title="Visualizar Publicaciones habilitados"><button class="button-Rev2" >Habilitados</button></a>  
                         </div>
                            
                            <table id="example" class="display" style="width:100%">
                              <thead>
                                <tr>
                                  <th class="heade">Título</th>
                                  <th class="heade">Descripción</th>
                                  <th class="heade">Imagen</th>
                                  <th class="heade">Habilitar</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                if (count($dataToView["data"]) > 0) {
                                  foreach ($dataToView["data"] as $data) {
                                ?>
                                    <tr>
                                      
                                      <td><?php echo $data['title']; ?></td>
                                      <td><?php echo $data['description']; ?></td>
                                      <td>
                                          <a class="example-image-link" href="<?php echo $data['image']; ?>" data-lightbox="example-<?php echo $data['title']; ?>" data-title="<?php echo $data['title']; ?>">
                                              <img class="example-image" src="<?php echo $data['image']; ?>" alt="Imagen publicación especial" width="70px" style="border-radius: 7px;" />
                                          </a>
                                      </td>

                                      <td >&nbsp&nbsp <a href="index.php?controller=pubEspecial&action=status&opc=enable&id=<?php echo $data['idPubSpecial'] ?> " title="Habilitar">
                                      <img src="asset/icon/enable.png" width=30px ></a></td>
                                      </a></td>
                                    </tr>
                                <?php
                                  }
                                } 
                                ?>
                              </tbody>
                            </table>
                        </div>

                  

                    </div>
                </main>

 
            <script>
                $(document).ready(function() {
                    $('#example').DataTable({
                        "columnDefs": [
                        { "width": "35%", "targets": 0 },
                        { "width": "35%", "targets": 1 },
                        { "width": "20%", "targets": 2 },
                        { "width": "10%", "targets": 3 },
                      
                        ],
                            "language": {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Ningún dato disponible en esta tabla",
                            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix":    "",
                            "sSearch":         "Buscar:",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst":    "Primero",
                                "sLast":     "Último",
                                "sNext":     "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
                        
                        }, 
                        "search": {
                                "searchPlaceholder": "Buscar:",
                                "searchButtonIcon": "fa fa-search",
                                "searchButtonClass": "buttton",
                                "searchInputClass": "form-control"
                            },
                            "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]],
                            "pageLength": 5
                    });
                });
            </script>
            
