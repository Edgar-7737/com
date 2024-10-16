<div class="register-box" >
	<div class="login-register-form" >
        <div>
        
        </div>
        <form id="formRegister" action="index.php?controller=users&action=editEmployee&id=<?php echo $dataToView['data']['idUser'] ?>" method="POST">
            <div class="form-container">
                <div class="form-section">
                    <!-- Primera parte del formulario -->
                    <label for="name">Nombre</label><br>
                    <input class="input-box" type="text" id="name" name="name" title="Nombre" value="<?php echo $dataToView['data']['name'] ?>" placeholder="Ingrese un Nombre"><br>
                    <div  class="errorMessage" id="errorMessagename"></div>

                    <label for="lastName">Apellido</label><br>
                    <input class="input-box" type="text" id="lastName" name="lastName" title="Apellido" value="<?php echo $dataToView['data']['lastName'] ?>" placeholder="Ingrese un Apellido"><br>
                    <div class="errorMessage" id="errorMessagelastName"></div>

                    
                </div>

                <div class="form-section">
                    <!-- Segunda parte del formulario -->
                    <label for="email">Correo</label><br>
                    <input class="input-box" type="text" id="email" name="email" title="Email" value="<?php echo $dataToView['data']['email'] ?>" placeholder="Ingrese un Correo"><br>
                    <div class="errorMessage" id="errorMessageemail"></div>

                    <label for="phone">Teléfono</label><br>
                    <input class="input-box" type="text" id="phone" name="phone" title="Teléfono" value="<?php if($dataToView['data']['phone'] !== 'POR ASIGNAR'){ echo $dataToView['data']['phone'];} ?>" placeholder="<?php echo $dataToView['data']['phone'] ?>"><br>
                    <div class="errorMessage" id="errorMessagephone"></div>

                    <!-- <label for="password">Contraseña</label><br>
                    <input class="input-box" type="password" id="password" name="password"  placeholder="*************" title="Contraseña"><br>
                    <div class="errorMessage" id="errorMessagepassword"></div>
                

                    <label for="password">Repita la Contraseña</label><br>
                    <input class="input-box" type="password" id="repPassword" name="repPassword"  placeholder="*************"  title="Repcontraseña"><br>
                    <div class="errorMessage" id="errorMessagerepPassword"></div><br> -->
                    
                    <input type="hidden" id="edit" name="edit" value="send" >
                
                </div>
            </div>     

            <input class="button-login-register" type="submit" title="Registrarse" value="Registrarse" name="send">
        </form>    
        <a href="index.php?controller=users&action=list&userType=publicista&status=1" title="Regresar"><button class="button-Rev" >Regresar</button></a>
       
        
        
        <div class="errorMessageFailedLog" id="errorMessage" ><p></p></div>
        
        <script src="asset\js\validations\registerValidationForm.js"></script>
        
        <div id="alert" nameAlert=<?php echo json_encode($_GET['response']); ?> modelAlert="editEmployee"></div>
        <script src="asset\js\scripts\alert.js"></script>
        
        
        <?php if(isset($_GET['response']) && $_GET['response'] === true ){?>
			<script>
				document.getElementById('errorMessage').textContent = "El usuario fue acualizado correctamente" ;
			</script>
		<?php }?>
            
        
    </div>
</div>  