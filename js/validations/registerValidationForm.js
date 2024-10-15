
let Check

const regexMap ={
    name : /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
    lastName : /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
    phone : /^[0-9\s]+$/,
    email:  /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ._%+\-@]+$/,
    password : /^[a-zA-Z0-9\-_.,;:$%#!¡?+*@]+$/,
    repPassword : /^[a-zA-Z0-9._%+\-@]+$/,
    
    // expreciones alternativas para evaluar el envio del formulario
    Bemail:  /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$/,
    Bpassword : /^(?=.*[a-zA-Z])(?=.*[\-_.,;:$%#!¡?+*@])(?=.*[0-9]).+$/,
    BrepPassword : /^(?=.*[a-zA-Z])(?=.*[\-_.,;:$%#!¡?+*@])(?=.*[0-9]).+$/
};

const regexMapMix ={
    name : /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
    lastName : /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/,
    phone : /^[0-9\s]*$/,
    email:  /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{1,20}$/,
    password : /^(?=.*[a-zA-Z])(?=.*[._%+\-@])(?=.*[0-9]).+$/,
    repPassword : /^(?=.*[a-zA-Z])(?=.*[._%+\-@])(?=.*[0-9]).+$/
};

const regexMIN ={
    name : 2,
    lastName : 2,
    phone : 11,
    email : 3 ,
    password : 8,
    repPassword : 8
};
const regexMAX ={
    name : 15,
    lastName : 15,
    phone : 11,
    email : 50,
    password : 16,
    repPassword : 16
};

const regexError ={
    name : "No debe tener caracteres especiales",
    lastName : "No debe tener caracteres especiales",
    phone : "No debe tener caracteres especiales, ejemplo 04241234567, 04121234567",
    email : "El correo no es adecuado, ejemplo: nombre@gmail.com, nombre@hotmail.com" ,
    password : "Utilice solo caracteres permitidos: - _ . , ; : $ % # ! ¡ ? + * @",
   
    Bpassword : "La contraseña debe tener al menos un número una letra y un caracter especial permitido  - _ . , ; : $ % # ! ¡ ? + * @",
    Bphone : "La logitud máxima del teléfono debe ser de 11 dígitos"
}

//que no se repitan los registros y se que guarden en minusculaes
//que la primera letra sea mayuscula y las demas minusculas

document.querySelectorAll('input').forEach(input => {
    
    input.addEventListener('keypress', function(e) {
        const inputField = e.target; 
        if (inputField.value.length >= regexMAX[input.name]){
            e.preventDefault();
            return;
        } 
        if(input.name !== 'repPassword' && input.name !== 'email'){
        const allowedCharacters = regexMap[input.name];
            if (!allowedCharacters.test(e.key)) {
                document.getElementById('errorMessage' + input.id).textContent = regexError[input.name];
                e.preventDefault();
            }else {
                document.getElementById('errorMessage' + input.id).textContent = "";
            }
        }else{
            document.getElementById('errorMessage' + input.id).textContent = "";
        }
    });  

    input.addEventListener('keydown', function(event) {
        if (event.keyCode === 8 || event.keyCode === 127 || event.keyCode === 46) { // Código ASCII para Backspace
            document.getElementById('errorMessage' + input.id).textContent = "";
            return ;
        }
    });  
});

/* Validación de los campos a través de las etiquetas input */
document.getElementById("formRegister").addEventListener("submit", function(event) {

    Check = {ok : false} ;
    const input = document.querySelectorAll('input');
    
    for (const data of input) {
        if(data.name === 'name' || data.name === 'lastName' || data.name === 'phone' || data.name === 'email' || data.name === 'password' || data.name === 'repPassword' ){

            if(data.name !== 'phone'){
                if (data.value.trim() === '') {
                    document.getElementById('errorMessage' + data.id).textContent = "El campo no debe estar vacío";
                    data.focus();
                    event.preventDefault();
                    break; 
                }
            }
            let error = regexError[data.name];
            if(data.name === 'password'){ error = regexError['Bpassword'];}
            if( data.name === 'phone' && data.value === 'POR ASIGNAR'){data.value = ''}

            let allowed = regexMapMix[data.name];
            if(!allowed.test(data.value)) {
                document.getElementById('errorMessage' + data.id).textContent = error;
                data.focus();
                event.preventDefault();
                break;
            } 
                
                
                if(data.name === 'phone'){
                    if(data.value === '' ){data.value = 'POR ASIGNAR'}
                    const phoneCode = ["0414", "0424", "0412", "0416", "0426", "0294","POR ASIGNAR"];
                    let valid = false;
                    for (const code of phoneCode){
                        if (data.value.startsWith(code)) {
                            valid=true;
                            break;
                            
                        }
                    
                    }
                    if(valid === false){
                        document.getElementById('errorMessage' + data.id).textContent = 'El numero de tlf debe comenzar con: "0414", "0424", "0412", "0416", "0426" ,"0294"';
                        data.focus();
                        event.preventDefault();
                        break;
                    }
                
                }
            
            error = `Debe tener entre ${regexMIN[data.name]} y ${regexMAX[data.name]} caracteres`;
            if(data.name === 'phone'){ error = regexError['Bphone']}
            const dataValue = data.value.trim();
            if (dataValue.length < regexMIN[data.name] || dataValue.length > regexMAX[data.name]) {
                document.getElementById('errorMessage' + data.id).textContent = error;
                data.focus();
                event.preventDefault();
                break;
            }
             
            const password = document.getElementById("password") ? document.getElementById("password").value : null;
            const repPassword = document.getElementById("repPassword") ? document.getElementById("repPassword").value : null;
            
        
           if (password !== repPassword && (password !== null || repPassword !== null)) {
            
                document.getElementById('errorMessagerepPassword').textContent = "La contraseña no coincide";
                event.preventDefault();
                break;
            }
        }
    }

    if (event.defaultPrevented) {
    } else {
        Check.ok = true;//si no se detecta un preventDefault significa que esta validado
    }

    

});