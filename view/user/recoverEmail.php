
<div class="contenido">
    <div class="model-box-default">
    <h2>Recuperacion de contraseña</h2><br>
    <form   id="formRecovery" action="index.php?controller=users&action=emailForRecover" method="POST" autocomplete="on">
        
        <label for="email">Correo</label><br>
        <input class="input-box" type="text" id="email" name="email" title="Email" placeholder="Ingrese un Correo"><br>
        <div class="errorMessage" id="errorMessageemail"></div>
		
		<div >
		<input class="button-login-register" type="submit" title="Enviar Correo" value="Enviar Correo" name="send" >
		</div>
	</form>

   
    

    <a href="index.php?controller=users&action=login"><button class="button-Rev" >Regresar</button></a>
    
    <div class="message" id="messageAlert"></div>
    <a  class="message" id="sendEmail" email=<?php if(isset($_GET['email'])) echo json_encode($_GET['email']); ?>></a>
    
    <script src="asset\js\validations\emailCodeValidationForm.js"></script>
        
    <div id="alert" nameAlert=<?php echo json_encode($_GET['response']); ?> modelAlert="user"></div>
    <script src="asset\js\scripts\alertAccess.js"></script> 
        
    </div> 
</div>