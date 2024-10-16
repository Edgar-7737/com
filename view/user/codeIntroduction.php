



<div class="contenido">
    <div class="model-box-default">
    
    <?php if(isset($_POST['action']) && $_POST['action'] === "validation" ){ ?>
        <h1>Activación de cuenta</h1>
    <?php }else if(isset($_POST['action']) && $_POST['action'] === "recover" ){ ?>
        <h1>Recuperacion de contraseña</h1> 
    <?php } ?>
    <br>
    <p class="message" > El código de verifiacción caducara en 10 minutos</p>
    <form   id="formRecovery" action="index.php?controller=users&action=codeValidation&opc=<?php if(isset($_POST['action'])) echo $_POST['action'];?>" method="POST" autocomplete="of">

        <label for="code">código de verifiacción</label><br>
        <input class="input-box" type="text" id="code" name="code" title="codigo de verifiaccion" placeholder="Ingrese el codigo de verifiacción"><br>
        <div class="errorMessage" id="errorMessagecode"></div>
        
        <input type="hidden" id="email" name="email" value="<?php echo $_POST['email'] ;?>" >
        <input type="hidden" id="hash" name="hash" value="<?php echo $_POST['hash'] ;?>" >
        
		<div >
		<input class="button-login-register" type="submit" title="Enviar Codigo" value="Enviar Codigo" name="send" >
		</div>
    
	</form>
    
    <?php if(isset($_POST['action']) && $_POST['action'] === "validation" ){ ?>
        <a href="index.php?controller=users&action=login"><button class="button-Rev" >Cancelar</button></a>
    <?php }else if(isset($_POST['action']) && $_POST['action'] === "recover" ){ ?>
        <a href="index.php?controller=users&action=emailForRecover"><button class="button-Rev" >Regresar</button></a>
    <?php } ?>
    


    <script src="asset\js\validations\emailCodeValidationForm.js"></script>

    <div class="message" id="messageAlert" ><p></p></div>
    <a  class="message" id="countdown"></a>
    <a  class="message" id="sendEmail" email=<?php if(isset($_GET['email'])) echo json_encode($_GET['email']); ?>></a>
    
    <div id="alert" nameAlert=<?php echo json_encode($_GET['response']); ?> modelAlert="codeIntroduction" actionModel=<?php if(isset($_POST['action'])) echo json_encode($_POST['action']);?>></div>
    <script src="asset\js\scripts\alertAccess.js"></script>        
    </div> 
</div>