<?php if(!isset($_SESSION['user']))header("location:". DEFAULT_ADDRESS_LOGOUT);?>  


 <div  >
   
           

    <div class="model-box-packages">
    <h1>Añadir Paquetes</h1>
        <form id="formPackages" action="index.php?controller=packages&action=insert" method="POST" autocomplete="off"  >
    
        <div class="form-container-model">

        <div class="form-section-model">
            
        
            <label for="title">Título</label><span class="obligatorio">*</span><br>              
            <input class="input-box" type="text" id="title" name="title" title="Ingrese un título" placeholder="Ingrese un título"><br>               
            <div class="errorMessage" id="errorMessagetitle" ><p></p></div><br>

            <label for="description">Descripcion</label><span class="obligatorio">*</span><br>
            <input  class="input-box" class="input-box-description" type="text" id="description" name="description" 
            placeholder="Ingrese una descripción" title="Ingrese una descripción"><br>
            <div class="errorMessage" id="errorMessagedescription" ><p></p></div><br>

            <label for="price">Precio</label><span class="obligatorio">*</span><br>
            <input class="input-box" type="text" id="price" name="price" title="Ingrese el precio" placeholder="Ingrese el precio"><br>
            <div class="errorMessage" id="errorMessageprice" ><p></p></div><br>
            
            
        </div>

        <div class="section-radiobox">
            
            <label for="transport">Transporte</label><span class="obligatorio">*</span><br>
            <label for="transport">SI</label>
            <input class="radio-input" type="radio" id="transport_yes" name="transport" value="SI" title="Transporte" >
            <label for="transport">NO</label>
            <input class="radio-input" type="radio" id="transport_no" name="transport" value="NO" title="transporte" ><br>
            <div class="errorMessage" id="errorMessagetransport"><p></p></div><br>
                    
            <label for="food">Comida</label><span class="obligatorio">*</span><br>
            <label for="food">SI</label>
            <input class="radio-input" type="radio"  id="food_yes" name="food" value="SI" title="Comida">
            <label for="food">NO</label>
            <input class="radio-input" type="radio"  id="food_no" name="food" value="NO" title="Comida"> <br>
            <div class="errorMessage" id="errorMessagefood" ><p></p></div><br>

            <label for="lodging">Hospedaje</label><span class="obligatorio">*</span><br>
            <label for="lodging">SI</label>
            <input class="radio-input" type="radio" id="lodging_yes" name="lodging" value="SI" title="Hospedaje">
            <label for="lodging">NO</label>
            <input class="radio-input" type="radio" id="lodging_no" name="lodging" value="NO" title="hospedaje"><br>
            <div class="errorMessage" id="errorMessagelodging" ><p></p></div><br>
        </div>
    </div>
            
    <input class="button-login-register" type="submit" title="Añadir" value="Añadir" name="send" > 
     
        </form>
        
        <a href="index.php?controller=packages&action=list" title="Cancelar "><button class="button-Rev">Cancelar</button></a>
        
        <div class="errorMessageFailedLog" id="errorMessage" ><p></p></div>
    
        <script src="asset\js\validations\packagesValidationForm.js"></script>

        <div id="alert" nameAlert=<?php echo json_encode($_GET['response']) ?> modelAlert="packages"></div>



        <script src="asset\js\scripts\alert.js"></script>


       
          
    </div>
</div>   