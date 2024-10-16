
<div  >

<link rel="stylesheet" href="asset/css/style.css">
<?php

/* declaracion de las variables e inicializacion */
$id = $query = $respond = "";

if(isset($dataToView["data"]->id_preg_frecuente)) 
  $id = $dataToView["data"]->id_preg_frecuente;

if(isset($dataToView["data"]->query)) 
  $query = $dataToView["data"]->query;

if(isset($dataToView["data"]->respond)) 
  $respond = $dataToView["data"]->respond;

?>
    
	<div class="model-box-default">
	<h2>Editar Pregunta Frecuente</h2>
		<form class="form" id="form" action="index.php?controller=faqs&action=saveFaq" method="POST">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />

				<!-- pararece la pregunta actual -->
				<div class="form__group" id="group__query">
					<label for="query" class="form__label">Pregunta</label><span class="obligatorio">*</span>
					<div class="form__group-input">
						<input class="input-box" class="form__input" type="text" name="query" id="query"  title="Ingrese una pregunta frecuente"
							placeholder="Ingrese una pregunta frecuente" value="<?php echo $query; ?>" />
						<i class="form__validate-state fas fa-times-circle"></i>
					</div>
					<p class="form__input-error">La pregunta no puede estar vacia, ni contener caracteres no apropiados.</p>
				</div>

				<!-- aparecer la respuesta actual -->
				<div class="form__group" id="group__respond">
					<label for="respond" class="form__label">Respuesta</label><span class="obligatorio">*</span>
					<div class="form__group-input">
						<input class="input-box" type="text" class="form__input" name="respond" id="respond"title="Ingrese la respuesta"
							placeholder="Ingrese la respuesta" value="<?php echo $respond; ?>">
						<i class="form__validate-state fas fa-times-circle"></i>
					</div>
					<p class="form__input-error">La respuesta no puede estar vacia, ni contener caracteres no apropiados.</p>
				</div>

			<div class="form__message" id="form__message">
			<p><b>Error:</b> Por favor rellene el formulario correctamente. </p>
		</div>
				
			<div>
			<button class="button-login-register" type="submit" title="Editar" name="send">Editar</button>
			<p class="form__message-success" id="form__message-success">guardado exitosamente!</p>
		</div>
				
			</form>
			<a class="" href="index.php?controller=faqs&action=listFaq" title="Cancelar"><button class="button-Rev">Cancelar</button></a>
		</div>
		<script src="asset\js\validations\script.js"></script>
	</div>
</div>