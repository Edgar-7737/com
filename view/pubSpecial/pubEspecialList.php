<?php  if(!isset($_SESSION['user'])) header("location: ".DEFAULT_ADDRESS_LOGOUT); ?>

                  <main>
                    <div class="header">
                        <div class="left"><h2>Publicaciones Especiales</h2></div>
                    </div>

              
                    <div class="bottom-data">
                        <div >
                        <div class="rift">
                          <a class="enlaces" href="index.php?controller=pubEspecial&action=listDisable" title="Visualizar Publicaciones Inhabilitados"><button class="button-Rev2" >Inhabilitados</button></a>
                          <a class="enlaces" href="index.php?controller=pubEspecial&action=insert" ><button class="button-Rev2" >Añadir</button></a> 
                        </div>   
                            
                            <table id="example" class="display" style="width:100%" >
                              <thead>
                                <tr>
                                  <th class="heade">Título</th>
                                  <th class="heade">Descripción</th>
                                  <th class="heade">Imagen</th>
                                  <th class="heade">Opciones</th>
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

                                      <td>
                                          <a href="index.php?controller=pubEspecial&action=edit&id=<?php echo $data['idPubSpecial'] ?> " title="Editar">
                                            <img src="asset/icon/edit.png" width=30px ></a>&nbsp&nbsp  
                                          <a href="index.php?controller=pubEspecial&action=status&opc=disable&id=<?php echo $data['idPubSpecial'] ?> " title="Inhabilitar">
                                          <img src="asset/icon/disable.png" width=30px></a>

                                      </td>
                                    </tr>
                                <?php
                                  }
                                } 
                                ?>
                              </tbody>
                            </table>
                        </div>
                      

    <script>
    $(document).ready(function(){
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
            }
        });
    });
  </script>
  </div>
                    </main>


  
     


