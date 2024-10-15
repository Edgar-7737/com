
<div class="contenido">
    

   
<br><div class="model-box-default">
    <h2>Editar Publicacion Especial</h2>
        <form class="seccion_caja" id="formPubSpecial" action="index.php?controller=pubEspecial&action=edit&id=<?php echo $dataToView['data']['idPubSpecial']; ?>" method="POST" enctype="multipart/form-data">
            <div>
                <label for="title">Título</label><span class="obligatorio">*</span>
                <br>
                <input class="input-box" type="text" title="Ingrese un título"  placeholder="Ingrese un título" id="title" name="title" value="<?php echo $dataToView['data']['title']; ?>" >
                <div class="errorMessage" id="errorMessagetitle"></div>
             
                <label for="descripcion">Descripción</label><span class="obligatorio">*</span>
                <br>
                <input class="input-box" title="Ingrese una descripción"  placeholder="Ingrese una descripción" id="description" name="description" rows="3" value="<?php echo $dataToView['data']['description']; ?>"  ></input>
                <div class="errorMessage" id="errorMessagedescription"></div>

                <label for="backup"><p>Imagen Actual</p>
                <input class="input-box" type="text" id="backup" name='backup' value="<?php echo $dataToView['data']['image']; ?>" readonly>
                <br><img src="<?php echo $dataToView['data']['image']; ?>" width="70">

            
                <br><label for="Newimage">Nueva Imagen</label>
                <div class="errorMessage" id="errorMessageimage"></div> 
                <br><input type="file" title="Nueva imagen" placeholder="Ingrese una Nueva imagen" id="image" name="image" onchange="previewImage(event)" >  
                <img src="" alt="" id="imagePreview"  width=70px> <br>
            </div>
            
            <input class="button-login-register" type="submit" title="Editar" value="Editar" name="send">
        </form>
        <a href="index.php?controller=pubEspecial&action=list" title="Cancelar"><button class="button-Rev">Cancelar</button></a>

        <script>
                function exito(){
                    swal.fire(
                        'Buen trabajo!',
                        'completado el envio',
                        'success'
                    )
                }
            </script>
            <script src="asset\js\validations\pubSpecialValidation.js"></script>
    </div>
</div>