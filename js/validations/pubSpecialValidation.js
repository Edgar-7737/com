const pubSpecial = {
  title : /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s _/.,-]+$/,
  description: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s¡!#"'-/_()@$.,¿?]+$/,
   alfa: /^[a-zA-Z0-9¿!]+$/
};

//valida que los caracteres para cada campo sean los que se extrablece
document.querySelectorAll('input[type="text"]').forEach(input => {

  const allowedCharacters = pubSpecial[input.name]; // Obtiene la expresión regular según el nombre del campo
  
  input.addEventListener('keypress', function(e) {
      if (!allowedCharacters.test(e.key)) {
          input.focus()
          document.getElementById('errorMessage' + input.id).textContent = `Caractere no validos para este campo`;
          e.preventDefault();
      }else {
          document.getElementById('errorMessage' + input.id).textContent = ""; // Limpia el mensaje de error
      }
  });
  
});

//valida que capte solo documentos del formato comun de imagenes
document.querySelector("#image").addEventListener("change", function(event) {
  var file = event.target.files[0];

  if (!(/.(gif|jpeg|jpg|png)$/i.test(file.name))) {   //------- Comprueba si La extensión es válida
      alert("Comprueba la extensión de tus imágenes. Los formatos aceptados son .gif, .jpeg, .jpg y .png.");
      event.preventDefault(); // Cancela la carga del archivo
      document.getElementById("image").value = ""; // Limpia el campo de entrada
  }
}, false);

/*
// Mostrar la vista previa de la imagen
function previewImage(event) {
  const imagePreview = document.getElementById('imagePreview');
  imagePreview.style.display = 'block';
  imagePreview.src = URL.createObjectURL(event.target.files[0]); 
} */

//valida que al enviar el formulario no alla campos vacios
document.getElementById("formPubSpecial").addEventListener("submit", function(event) {

  const input = document.querySelectorAll('input');

  for (const data of input) { 
  
      if (data.value.trim() === '') {
          document.getElementById('errorMessage' + data.id).textContent = "El campo no debe estar vacío";
          data.focus();
          event.preventDefault();
          break;  
      }  
                
      if((data.name === 'title')){
          const valueData = data.value[0];
          const allowed =/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/;
          if(! allowed.test(valueData)){
              document.getElementById('errorMessage' + data.id).textContent = "El campo no debe empezar con caracteres especiales"
              event.preventDefault();
              break;
          }
      }

      let allowedCharacters = pubSpecial[data.name];
      
      if (!allowedCharacters.test(data.value)) {
          document.getElementById('errorMessage' + data.id).textContent = `Caractere no validos para este campo`;
          data.focus();
          event.preventDefault();
          break;
      }

      if(data.name === 'backup') return;
  }

});
