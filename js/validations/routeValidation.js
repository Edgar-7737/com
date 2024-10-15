const regexRoute = {
    place  : /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s _/.,-]+$/,
    location : /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s _/.,-]+$/,
    description: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s¡!#"'-/_()@$.,¿?]+$/,
    alfa: /^[a-zA-Z0-9¿!]+$/
};

//valida que los caracteres para cada campo sean los que se extrablece
document.querySelectorAll('input[type="text"]').forEach(input => {

    const allowedCharacters = regexRoute[input.name]; // Obtiene la expresión regular según el nombre del campo
    
    input.addEventListener('keypress', function(e) {
        if (!allowedCharacters.test(e.key)) {
            input.focus()
            document.getElementById('errorMessage' + input.id).textContent = `Caracter no validos para este campo`;
            e.preventDefault();
        }else {
            document.getElementById('errorMessage' + input.id).textContent = ""; // Limpia el mensaje de error
        }
    });
    
});
//valida que la imagen sea del formato que establece y ofrece una vista previa o limpia los campos segun el caso
document.querySelector("#image").addEventListener("change", function(event) {
    var file = event.target.files[0];
    var imagePreview = document.getElementById('imagePreview');

    if (!file || !(/\.(jfif|jpeg|jpg|png)$/i.test(file.name))) {   // Comprueba si la extensión es válida
        alert("Comprueba la extensión de tus imágenes. Los formatos aceptados son .jfif, .jpeg, .jpg, .png");
        event.preventDefault(); // Cancela la carga del archivo
        document.getElementById("image").value = ""; // Limpia el campo de entrada
        imagePreview.style.display = 'none'; // Oculta la vista previa
        imagePreview.src = ""; // Limpia la fuente de la imagen
        document.getElementById('errorMessageimage').textContent = "Formato de archivo no válido.";
    } else {
        imagePreview.style.display = 'block';
        imagePreview.src = URL.createObjectURL(file); 
        document.getElementById('errorMessageimage').textContent = "";
    }
}, false);
//limpia el mensaje de error de parroquia al ser selccionado
document.getElementById('parroquia').addEventListener('change', function() {
    document.getElementById('errorMessageparroquia').textContent = ""; // Limpia el mensaje de error
});
//////////////////////////////////////////////////

//valida que al enviar el formulario no alla campos vacios al enviar
document.getElementById("route").addEventListener("submit", function(event) {

    const cbxParroquia = document.getElementById('parroquia');//comprobar que el sellcc noo quede vacio al enviar el formulario
    if(cbxParroquia.value ===''){
        document.getElementById('errorMessageparroquia').textContent = "El campo no debe estar vacío";
        event.preventDefault();
        return;
    }else{
        document.getElementById('errorMessageparroquia').textContent = ""; // Limpia el mensaje de error
    }

    const input = document.querySelectorAll('input');//comprueba que los imput distintos delos mencionados no se envien vacios
    for (const data of input) { 
        if(data.name !== 'send' && data.name !== '' && data.name !== 'estado' && data.name !== 'municipio' && data.name !== 'backup' ){
            if (data.value.trim() === '') {
                document.getElementById('errorMessage' + data.id).textContent = "El campo no debe estar vacío";
                data.focus();
                event.preventDefault();
                break;  
            }else{
                document.getElementById('errorMessage' + data.id).textContent = ""; // Limpia el mensaje de error
            }  
                    
            if((data.name === 'place')||(data.name === 'location')){//comprueba que los imput lugar y calle no empiecen con caracteres espc
                const valueData = data.value[0];
                const allowed =/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/;
                if(! allowed.test(valueData)){
                    document.getElementById('errorMessage' + data.id).textContent = "El campo no debe empezar con caracteres especiales"
                    event.preventDefault();
                    break;
                }else{
                    document.getElementById('errorMessage' + data.id).textContent = ""; // Limpia el mensaje de error
                }
            }

            //comrpueba que los campos no se envien con caracteres no validos
            let allowedCharacters = regexRoute[data.name];
            if(data.name !== 'send' && data.name !== '' && data.name !== 'estado' && data.name !== 'municipio' && data.name !== 'parroquia' && data.name !=='image' && data.name !== 'backup' ){
                if (!allowedCharacters.test(data.value)) {
                    document.getElementById('errorMessage' + data.id).textContent = `Caracter no validos para este campo`;
                    data.focus();
                    event.preventDefault();
                    break;
                }else{
                    document.getElementById('errorMessage' + data.id).textContent = ""; // Limpia el mensaje de error
                }
            } 
            
        }
        if(data.name === 'backup') return;
    }
    

});


