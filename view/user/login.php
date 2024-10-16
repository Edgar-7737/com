


<div class="contenido" >
	
<div class="login-box" >
	<div class="login-register-form" >

	<form   id="loginForm" action="index.php?controller=users&action=login" method="POST" autocomplete="on">
		
		<label for="email">Correo</label><br>
		<input class="input-box" type="text" id="email" name="email" title="Email"  placeholder="Ingrese un Correo" require><br>
		
		<div class="errorMessage" id="errorMessageemail"></div>
		
		<label for="password">Contraseña</label><br>
		<input class="input-box" type="password" id="password" name="password" title="Contraseña"  placeholder="Ingrese una Contraseña" require><br>
		<div class="errorMessage" id="errorMessagepassword"></div>	
		<div >
		<input class="button-login-register" type="submit" title="Iniciar Sesion" value="Iniciar Sesion" name="send" >
		</div>
	
           
	</form>

		<a href="index.php?controller=home" title="Regresar"><button class="button-Rev">Regresar</button></a>
		<p class="message">¿No estas Registrado? <a href="index.php?controller=users&action=register">Crear Cuenta</a></p><br>
		<p class="message">¿Olvidaste tu contraseña? <a href="index.php?controller=users&action=emailForRecover">Recuperar Contraseña</a></p><br>		
		
		<div class="message" id="messageAlert" ><p></p></div>
        <a  class="message" id="countdown"></a>
        <a  class="message" id="sendEmail" email=<?php if(isset($_GET['email'])) echo json_encode($_GET['email']); ?>></a>
        
		<script src="asset\js\validations\loginValidationForm.js"></script>

        <div id="alert" nameAlert=<?php echo json_encode($_GET['response']); ?> modelAlert="login"></div>
        <script src="asset\js\scripts\alertAccess.js"></script>

		
		
	</div>
</div>
	


