
<?php if(!isset($_SESSION['user']))header("location:". DEFAULT_ADDRESS_LOGOUT);?>  
        
    <br>

    <div class="model-box-packages">

    <h2>Editar Paquete</h2>
    <form id="formPackages" action="index.php?controller=packages&action=edit&id=<?php echo $dataToView['data']['idPackages']; ?>" method="POST"  >
        <div class="form-container-model">
            <div class="form-section-model">
                
                <label for="title">Título</label><span class="obligatorio">*</span><br>
                <input class="input-box" type="text" id="title" name="title" title="Ingrese un título"  placeholder="Ingrese un título" value="<?php echo $dataToView['data']['title']; ?>"><br>               
                <div class="errorMessage" id="errorMessagetitle" ><p></p></div><br>

                <label for="description">Descripción</label><span class="obligatorio">*</span><br>
                <input class="input-box" type="text" id="description" name="description" title="Ingrese una descripción" placeholder="Ingrese una descripción" value="<?php echo $dataToView['data']['description']; ?>"><br>
                <div class="errorMessage" id="errorMessagedescription" ><p></p></div><br>
                
                <label for="price">Precio</label><span class="obligatorio">*</span><br>
                <input class="input-box" type="text" id="price" name="price" title="Ingrese el precio" placeholder="Ingrese el precio" value="<?php echo $dataToView['data']['price']; ?>" ><br>
                <div class="errorMessage" id="errorMessageprice" ><p></p></div><br>
               
            </div>
            <div class="section-radiobox">

                <label for="transport">Transporte</label><span class="obligatorio">*</span><br>
                <label for="transport">SI</label> 
                <input class="radio-input" type="radio" id="transport_yes" name="transport" value="SI" title="Transporte" <?php if($dataToView['data']['transport'] === 'SI'){ echo 'checked';} ?>>
                <label for="transport">NO</label> 
                <input class="radio-input" type="radio" id="transport_no" name="transport" value="NO" title="Transporte" <?php if($dataToView['data']['transport'] === 'NO'){ echo 'checked';} ?>><br>
                <div class="errorMessage" id="errorMessagetransport"><p></p></div><br>
                
                <label for="food">Comida</label><span class="obligatorio">*</span><br>
                <label for="food">SI</label>
                <input class="radio-input" type="radio"  id="food_yes" name="food" value="SI" title="Comida" <?php if($dataToView['data']['food'] === 'SI'){ echo 'checked';} ?>>
                <label for="food">NO</label>
                <input class="radio-input" type="radio"  id="food_no" name="food" value="NO" title="Comida" <?php if($dataToView['data']['food'] === 'NO'){ echo 'checked';} ?>><br>
                <div class="errorMessage" id="errorMessagefood" ><p></p></div><br>

                <label for="lodging">Hospedaje</label><span class="obligatorio">*</span><br>
                <label for="lodging">SI</label>
                <input class="radio-input" type="radio" id="lodging_yes" name="lodging" value="SI" title="hospedaje" <?php if($dataToView['data']['lodging'] === 'SI'){ echo 'checked';} ?>>
                <label for="lodging">NO</label>
                <input class="radio-input" type="radio" id="lodging_no" name="lodging" value="NO" title="hospedaje" <?php if($dataToView['data']['lodging'] === 'NO'){ echo 'checked';} ?>><br>
                <div class="errorMessage" id="errorMessagelodging" ><p></p></div><br>
            </div>     
        </div>
       
        <input type="hidden" id="edit" name="edit" value="send" >

        <input  class="button-login-register" id="send" type="submit" title="Editar" value="Editar" name="send">
    </form>
    
    <div class="errorMessageFailedLog" id="errorMessage" ><p></p></div>
    
    <a href="index.php?controller=packages&action=list" title="Cancelar "><button class="button-Rev" >Cancelar</button></a>
    
    <script src="asset\js\validations\packagesValidationForm.js"></script>
    <div id="alert" nameAlert=<?php echo json_encode($_GET['response']) ?> modelAlert="packages" ></div>
    <script src="asset\js\scripts\alert.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if(check.ok === true){
        const forms = document.querySelectorAll('form');

        forms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Evita el envío normal del formulario

                const url = form.action;
                const formData = new FormData(form);

                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    switch (data) {
                        case 'success':
                            alert('Formulario enviado con éxito');
                            window.location.href = '/pagina-de-redireccion'; // Cambia esto a la URL de redirección deseada
                            break;
                        case 'error':
                            alert('Hubo un error al enviar el formulario');
                            break;
                        default:
                            alert('Respuesta del servidor: ' + data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    }
});
</script>

    

    

   
</div>

