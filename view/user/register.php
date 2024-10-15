

<div class="register-box" >
	<div class="login-register-form" >
        <div>
        <h1>Registrate</h1>
        </div>
        <form id="formRegister" action=<?php if( isset($_GET['userType']) && $_GET['userType'] === 'publicist'){ echo "index.php?controller=users&action=registerPublicist" ;}else{ echo "index.php?controller=users&action=register";} ?> method="POST">
            <div class="form-container">
                <div class="form-section">
                    <!-- Primera parte del formulario -->
                    <label for="name">Nombre</label><br>
                    <input class="input-box" type="text" id="name" name="name" title="Nombre" placeholder="Ingrese un Nombre"><br>
                    <div  class="errorMessage" id="errorMessagename"></div>

                    <label for="lastName">Apellido</label><br>
                    <input class="input-box" type="text" id="lastName" name="lastName" title="Apellido"  placeholder="Ingrese un Apellido"><br>
                    <div class="errorMessage" id="errorMessagelastName"></div>

                    <label for="phone">Teléfono</label><br>
                    <input class="input-box" type="text" id="phone" name="phone" title="Teléfono" placeholder="Ingrese un Telefono"><br>
                    <div class="errorMessage" id="errorMessagephone"></div>
                </div>

                <div class="form-section">
                    <!-- Segunda parte del formulario -->
                    <label for="email">Correo</label><br>
                    <input class="input-box" type="text" id="email" name="email" title="Email" placeholder="Ingrese un Correo"><br>
                    <div class="errorMessage" id="errorMessageemail"></div>

                    <label for="password">Contraseña</label><br>
                    <input class="input-box" type="password" id="password" name="password" placeholder="Ingrese una Contraseña" title="Contraseña"><br>
                    <div class="errorMessage" id="errorMessagepassword"></div>
                

                    <label for="password">Repita la Contraseña</label><br>
                    <input class="input-box" type="password" id="repPassword" name="repPassword" placeholder="Repita la contraseña"  title="Repcontraseña"><br>
                    <div class="errorMessage" id="errorMessagerepPassword"></div><br>

                </div>
            </div>    

            <input class="button-login-register" type="submit" title="Registrarse" value="Registrarse" name="send">
        </form>    
        <?php if( isset($_GET['userType']) && $_GET['userType'] === 'publicist'){?>
        <a href="index.php?controller=users&action=list&userType=publicista&status=1" title="Regresar"><button class="button-Rev" >Regresar</button></a><?php }else{ ?>
        <a  href="index.php?controller=home" title="Regresar"><button class="button-Rev" >Regresar</button></a>
        <p  class="message" >¿Ya tienes una cuenta? <a href="index.php?controller=users&action=login">Inicia Sesión</a></p><br><?php } ?>
        
       
        <div class="message" id="messageAlert"><p></p></div>
        <a  class="message" id="countdown"></a>
        <a  class="message" id="sendEmail" email=<?php if(isset($_GET['email'])) echo json_encode($_GET['email']); ?> ></a>
        <script src="asset\js\validations\registerValidationForm.js"></script>
        
        <div id="alert" nameAlert=<?php echo json_encode($_GET['response']) ?> modelAlert="register"></div>
        <script src="asset\js\scripts\alertAccess.js"></script>

        
    </div>
</div>  