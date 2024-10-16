<?php 
if(!isset($_SESSION['user']))header("location:". DEFAULT_ADDRESS_LOGOUT);
 require_once("model/address.php"); ?>
        
<div class="contenido" >
   
    
    <br><div class="model-box-default">
    <h2>Editar Ruta</h2>
        <form  id="route" action="index.php?controller=route&action=editRoute&id=<?php echo $dataToView['data']['idRoute']; ?>" method="POST" enctype="multipart/form-data"  >
            <div>
                <p>Dirección</p><br>
            <?php
            $aux = $address->getDependence($dataToView['data']['idParroquia']); 
                if (count($aux) > 0) {
                    foreach ($aux as $row) {
            ?>            
            <label for="estado">Estado</label>
            <select name="estado" id="estado">
                <option value=""><?php echo $row['estado']; ?></option>
                <?php
                $result = $address->addressEdo();
                if (count($result) > 0) {
                    foreach ($result as $data) {
                        echo '<option value="' . $data['id_e'] . '">' . $data['estado'] . '</option>';
                    }
                }
                ?>
            </select>

            <br><label for="municipio">Municipio</label>
            <select name="municipio" id="municipio">
                <option value=""><?php echo $row['municipio']; ?></option>   
            </select>

            <br><label for="parroquia">Parroquia</label>
                <select name="parroquia" id="parroquia">
                    <option value="<?php  echo $dataToView['data']['idParroquia'];?>"><?php echo $row['parroquia']; ?></option>
                </select>
                <div class="errorMessage" id="errorMessageparroquia"></div> 
            <?php
                }
            } 
            ?>
            <script src="asset/js/requests/requestsRoute.js"></script>  
            
             <br><label for="location">Comunidad/Calle</label><span class="obligatorio">*</span><br>
                <input class="input-box" type="text" id="location" name="location" title="Ingrese una ubicación" 
                placeholder="Ingrese una ubicación" maxlength="45" value="<?php echo $dataToView['data']['location']; ?>">
                <div class="errorMessage" id="errorMessagelocation"></div>

            <label for="place">Lugar</label><span class="obligatorio">*</span><br>
                <input class="input-box" type="text"  id="place" name="place" title="Ingrese un lugar"  
                placeholder="Ingrese un lugar" maxlength="45" value="<?php echo $dataToView['data']['place']; ?>">
                <div class="errorMessage" id="errorMessageplace"></div>

               

                <label for="description">Descripción</label><span class="obligatorio">*</span><br>
                <input class="input-box" type="text"  id="description" name="description" title="Ingrese una descripción" 
                placeholder="Ingrese una descripción" maxlength="150" value="<?php echo $dataToView['data']['description']; ?>">
                <div class="errorMessage" id="errorMessagedescription"></div>

                
                <label for="backup"><p>Imagen actual</p></label>
                <input class="input-box" type="text" id="backup" name='backup' value="<?php echo $dataToView['data']['image']; ?>" readonly>
                <br><img src="<?php echo $dataToView['data']['image']; ?>" width="70">

            
                <br><label class="custom-file-upload" for="Newimage">Nueva imagen</label>
                <div class="errorMessage" id="errorMessageimage"></div> 
                <br><input  class="custom-file-upload" type="file" title="Seleccione una imagen" placeholder="Seleccione una imagen" id="image" name="image" >  
                <img src="" alt="" id="imagePreview"  width=70px> <br>
            </div>
            
            <input class="button-login-register" type="submit" title="Editar" value="Editar" name="send" >
        </form>
        <a href="index.php?controller=route&action=listRouteEnabled" title="Cancelar"><button class="button-Rev">Cancelar</button></a>
        <script src="asset\js\validations\routeValidation.js"></script>
       
    </div>
</div>