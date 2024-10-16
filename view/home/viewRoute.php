<!-- VISTA PARA LOS TURISTAS.. DETALLE DE LAS RUTAS (LLAMADO DESDE EL CONTROLHOME) -->

<?php 
//este segmento es para elegir la Ruta en el Formulario de añadir viaje
require_once("model/address.php");
?>
<section>   
    <h2>Rutas</h2>
    <div class="horizontal-scroll">
        <?php if(count($dataToView["data"])>0){  ?>  
            <?php  foreach($dataToView["data"] as $data){ ?>
                <div class="route-item">
                    <?php echo "Ruta #". $data['idRoute']; ?>
                    <table border="1" width=250px height= 150px>
                        <thead>
                        <th ><?php echo $data['place']; ?></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Comunidad-Calle: <?php echo $data['location']; ?></td>
                            </tr>
                            
                         <?php
                          $aux = $address->getDependence($data['idParroquia']); 
                          if (count($aux) > 0) {
                            foreach ($aux as $row) {
                        ?>
                        <tr>
                            <td>Parroquia: <?php echo $row['parroquia']; ?></td>
                        </tr>
                        <tr>
                             <td>Municipio: <?php echo $row['municipio']; ?></td>
                        </tr>
                        <tr>
                            <td>Estado: <?php echo $row['estado']; ?></td>
                        </tr>
                        <?php
                            }
                          } 
                        ?>
                            <tr>
                                <td>Descripcion<?php echo $data['description']; ?></td>
                            </tr> 
                            <tr>
                                <td><img src="<?php echo $data['image']; ?>" width="250px" height= 150px></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div>
                Actualmente No Hay Rutas Disponibles.
            </div>
        <?php } ?> 
    </div>
</section>


  

