<?php 
if(!isset($_SESSION['user']))header("location:". DEFAULT_ADDRESS_LOGOUT);
require_once("model/address.php"); 
?>

<div class="contenido">

    <div class="model-box-default">
        <h2>Añadir Rutas</h2><br>

        <form id="route" action="index.php?controller=route&action=addRoute" method="POST"
            enctype="multipart/form-data">
            <div>
            <h4>Dirección</h4>
            <label for="estado">Estado</label>
            <select name="estado" id="estado">
                <option value="">Seleccionar</option>
                <?php
                
                $result = $address->addressEdo();
                if (count($result) > 0) {
                    foreach ($result as $row) {
                        echo '<option value="' . $row['id_e'] . '">' . $row['estado'] . '</option>';
                    }
                }
                ?>
            </select><br>

            <label for="municipio">Municipio</label>
            <select name="municipio" id="municipio">
                <option value="">Seleccionar</option>   
            </select><br>

            <label for="parroquia">Parroquia</label>
                <select name="parroquia" id="parroquia">
                    <option value="">Selecionar</option>
                </select><br>
            <div class="errorMessage" id="errorMessageparroquia"></div> 

            <script src="asset/js/requests/requestsRoute.js"></script>  

            <label for="location">Comunidad/Calle</label>
                <input class="input-box" type="text" id="location" name="location" title="Ingrese una Ubicación"
                    maxlength="45" placeholder="Ingrese una Ubicación">
                <div class="errorMessage" id="errorMessagelocation"></div>

                <label for="place">Lugar</label>
                <input class="input-box" type="text" id="place" name="place" title="Ingrese un Lugar" maxlength="45"
                    placeholder="Ingrese un Lugar">
                <div class="errorMessage" id="errorMessageplace"></div>

                <label for="description">Descripción</label>
                <input class="input-box" type="text" id="description" name="description" title="Ingrese una Descripción"
                    maxlength="150" placeholder="Ingrese una Descripción">
                <div class="errorMessage" id="errorMessagedescription"></div>

                <label  for="image" >Imagen</label>
                <div class="errorMessage" id="errorMessageimage"></div>
                <input  class="custom-file-upload" type="file" title="Seleccione una  Imagen" placeholder="Seleccione una  Imagen" 
                    name="image" id="image" >
                <p>Vista previa</p>
                <img src="" alt="" id="imagePreview" width=150px >
           
            </div>

            <input class="button-login-register" type="submit" title="Añadir Rutas" value="Añadir" name="send">
            
        
        </form>
        <a href="index.php?controller=route&action=listRouteEnabled" title="Cancelar"><button
                class="button-Rev">Cancelar</button></a>
        <script  src="asset\js\validations\routeValidation.js"></script>
    </div>
</div>

