<?php if(!isset($_SESSION['user'])) header("location: ".DEFAULT_ADDRESS_LOGOUT); ?>

<!-- Incluye el estilo de Cropper.js -->
<link rel="stylesheet" href="asset/css/cropperStyle.css"/>
<!-- Incluye el estilo del modal de Cropper.js -->
<link rel="stylesheet" href="asset/css/styleModalCropper.css"/>

<div class="contenido">
    <div class="model-box-default">
        <h1>Añadir Publicación Especial</h1>
        <form id="formPubSpecial" action="index.php?controller=pubEspecial&action=insert" method="POST" enctype="multipart/form-data">
            <div>
                <label for="title">Título</label><span class="obligatorio">*</span>
                <br>
                <input class="input-box" type="text" title="Ingrese un título" placeholder="Ingrese un título" id="title" name="title">
                <div class="errorMessage" id="errorMessagetitle"></div>

                <label for="description">Descripción</label><span class="obligatorio">*</span>
                <br>
                <input class="input-box" type="text" title="Ingrese una descripción" placeholder="Ingrese una descripción" id="description" name="description">
                <div class="errorMessage" id="errorMessagedescription"></div>


                <label for="image">Imagen</label><span class="obligatorio">*</span> 
                <input type="file" title="Seleccione una imagen" placeholder="Seleccione una imagen" id="image" name="image" onchange="openCropModal(event)">
                
                <!-- Enlace de Lightbox alrededor de la imagen de vista previa -->
                <a id="lightboxLink" href="#" data-lightbox="example-image" style="display: none;">
                    <img id="imagePreview" alt="Vista previa de la imagen" style="display: none; max-width: 180px; max-height: 180px;">
                </a>

                <div class="errorMessage" id="errorMessageimage"></div>
            </div>
            
            <br>
            <input class="button-login-register" type="submit" title="Añadir" value="Añadir" name="send">
        </form>

        <div id="errorMessage"><p></p></div>

        <a href="index.php?controller=pubEspecial&action=list" title="Cancelar"><button class="button-Rev">Cancelar</button></a>

        <script src="asset/js/validations/pubSpecialValidation.js"></script>

        <div>
            <?php 
            if(isset($_GET['response']) && $_GET['response'] == true){
            ?>
            <p>
                La publicación ha sido insertada exitosamente
            </p>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- Modal para editar la imagen -->
<div id="cropModal" style="display:none;">
    <div class="modal-content">
        <h2>Editar Imagen</h2>
        <div class="cropper-container">
            <img id="imageToCrop" alt="Vista previa de la imagen" style="max-width: 100%;">
        </div>
        <button id="cropButton" style="display: none;">Aceptar Modificación</button>
        <button id="closeModal">Cerrar</button>
    </div>
</div>

<!-- Script para la implementación de Cropper.js -->
<script src="asset/js/app/cropper.js"></script>
<!-- Script para la implementación del modal de Cropper.js -->
<script src="asset/js/app/modalCropper.js"></script>


