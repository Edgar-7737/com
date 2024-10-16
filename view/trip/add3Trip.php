<?php 
    require_once("controller/packages.php");  
    $packages= new packagesController;
    $dataToView['data'] = $packages->list();
?>  
<section>   
    <label for="idPackages">Seleccione su Paquete de Viaje</label>
    <div class="errorMessage" id="errorMessageidPackages"></div>
    <div class="horizontal-scroll">
        <?php if(count($dataToView["data"])>0){  ?>  
        
            <?php
            foreach($dataToView["data"] as $data){ 
            ?>
            <div class="route-item">
            
                    <label for="package<?php echo $data['idPackages']; ?>">
                        <div class="package-details">
                            <?php echo "Paquete #" . $data['idPackages']; ?><input class="input-box" type="checkbox" id="package<?php echo $data['idPackages']; ?>" name="idPackages[]" title="Seleccione un paquete de viaje" value="<?php echo $data['idPackages']; ?>">
                            <table border="1" width="150px" height="150px">
                                <thead><tr><th><?php echo "Título: " . $data['title']; ?></th></tr></thead>
                                <tbody>
                                    <tr><td><?php echo "Descripción: " . $data['description']; ?></td></tr>
                                    <tr><td><?php echo "Transporte: " . $data['transport']; ?></td></tr>
                                    <tr><td><?php echo "Comida: " . $data['food']; ?></td></tr>
                                    <tr><td><?php echo "Hospedaje: " . $data['lodging']; ?></td></tr>
                                    <tr><td><?php echo "Precio: " . $data['price']; ?></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </label>
                </div>
                <br>
            <?php } ?>
        <?php } else { ?>
            <div>
                Actualmente No Hay Paquetes Disponibles.
            </div>
        <?php } ?>
    </div>
</section>