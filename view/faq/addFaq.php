
<div class="contenido" >

<link rel="stylesheet" href="asset/css/style.css">



  <div class="model-box-default">
    <h3>Añadir Pregunta Frecuente</h3><br>
      <form class="form" id="form" action="index.php?controller=faqs&action=addFaq" method="POST"  >
      
        <!-- group: query -->
        <div class="form__group" id="group__query">
          <label for="query" class="form__label">Pregunta</label><span class="obligatorio">*</span>
          <div class="form__group-input">
            <input class="input-box" type="text" class="form__input" name="query" id="query" title="Ingrese una pregunta frecuente" placeholder="Ingrese una pregunta frecuente">
            <i class="form__validate-state fas fa-times-circle"></i>
          </div>
            <p class="form__input-error">La pregunta no puede estar vacia, ni contener caracteres no apropiados.</p>
        </div>

          <!-- group: respond -->
        <div class="form__group" id="group__respond">
          <label for="respond" class="form__label">Respuesta</label><span class="obligatorio">*</span>
          <div class="form__group-input">
            <input class="input-box" type="text" class="form__input" name="respond" id="respond" title="Ingrese la respuesta" placeholder="Ingrese la respuesta">
            <i class="form__validate-state fas fa-times-circle"></i>
          </div>
          <p class="form__input-error">La respuesta no puede estar vacia, ni contener caracteres no apropiados.</p>
        </div>

        <div class="form__message" id="form__message">
          <p><b>Error:</b> Por favor rellene el formulario correctamente. </p>
        </div>


        <div >
          <button class="button-login-register" type="submit"  title="Añadir">Añadir</button>
          <p class="form__message-success" id="form__message-success">guardado exitosamente!</p>
        </div>

        
      </form>
      <a class="" href="index.php?controller=faqs&action=listFaq" title="Cancelar"><button class="button-Rev">Cancelar</button></a>
      <script src="asset\js\validations\script.js"></script>

      </div>
      

</div>