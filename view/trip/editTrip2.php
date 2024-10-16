<section>   
    <label  for="idRoute">Seleccione una Ruta</label>
    <div class="errorMessage" id="errorMessageidRoute"></div>
    <div class="horizontal-scroll">
        <?php // if(count($dataToView["data"])>0){  ?>  
            <?php // foreach($dataToView["data"] as $data){ ?>
                <div class="route-item">
                    <?php echo "Ruta #". $dataToView['data']['idRoute']; ?><input class="input-box" type="radio" id="idRoute" name="idRoute" title="Seleccione una ruta de viaje"
                                    value="<?php echo $dataToView['data']['idRoute']; ?>">
                    <table border="1" width=400px height= 250px;>
                        <thead>
                            <th><?php echo $dataToView['data']['place']; ?></th>
                            <th>
                                </thead>
                        <tbody>
                            <tr>
                                <td>Comunidad-Calle</td>
                                <td><?php echo $dataToView['data']['location']; ?></td>
                            </tr>
                        <tr>
                            <td>Parroquia</td>
                            <td><?php echo $dataToView['data']['parroquia']; ?></td>
                        </tr>
                        <tr>
                            <td>Municipio</td>
                             <td><?php echo $dataToView['data']['municipio']; ?></td>
                        </tr>
                        <tr>
                            <td>Estado</td>
                            <td><?php echo $dataToView['data']['estado']; ?></td>
                        </tr>
                        
                            <tr>
                                <td>Descripción</td>
                                <td><?php echo $dataToView['data']['description']; ?></td>
                            </tr> 
                            <tr>
                                <td colspan="2"><img src="<?php echo $dataToView['data']['image']; ?>" width="150x" height= 100px;></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php //} ?>
        <?php//} else { ?>
            <div class="errorMessage">
                <!-- Actualmente No Hay Rutas Disponibles. -->
            </div>
        <?php //} ?> 
    </div>
</section>
