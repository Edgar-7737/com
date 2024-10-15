<div class="contenido">
    <div class="model-box-default">
        <h2>Cambio de contraseña</h2><br>
        
        <form id="formRecovery" action="index.php?controller=users&action=changePassword" method="POST">
        
        <label for="password">Contraseña</label><br>
        <input class="input-box" type="password" id="password" name="password" placeholder="Ingrese una Contraseña" title="Contraseña"><br>
        <div class="errorMessage" id="errorMessagepassword"></div>
    

        <label for="password">Repita la Contraseña</label><br>
        <input class="input-box" type="password" id="repPassword" name="repPassword" placeholder="Repita la contraseña"  title="Repcontraseña"><br>
        <div class="errorMessage" id="errorMessagerepPassword"></div><br>
        <?php if(isset($_POST['email'])){?><input type="hidden"  id="email" name="email" title="Email" value=<?php echo $_POST['email'] ?>><br><?php }?>
        
        <input class="button-login-register" type="submit" title="Cambiar Contraseña" value="Cambiar Contraseña" name="send">

        </form>
        <a href="index.php?controller=users&action=login"><button class="button-Rev" >Cancelar</button></a>

        
        <div class="message" id="messageAlert" ></div>
        <script src="asset\js\validations\emailCodeValidationForm.js"></script>

        <div class="message" id="errorMessage" ><p></p></div>
    
        <div id="alert" nameAlert=<?php echo json_encode($_GET['response']); ?> modelAlert="codeIntroduction"></div>
        <script src="asset\js\scripts\alertAccess.js"></script>  

        

    </div> 
</div>