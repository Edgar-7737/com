const alert = document.getElementById('alert');
const nameAlert = alert.getAttribute('nameAlert');
const modelAlert = alert.getAttribute('modelAlert');


const bigAlert = Swal.mixin({
    confirmButtonColor: "#808180",
    cancelButtonColor: "#808180",
    timer: 3000,
    width: "25em",
    padding: "1em",   
});

const Toast = Swal.mixin({
    position: "bottom",
    timer: 5000,
    toast: true,
    showConfirmButton: false,
    timerProgressBar: true,
    didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
    }
});


switch(nameAlert){
    /**Respuesta para cuando se introduce mal el usuario y la contraseña */
    case "incorrect_email_pass":
        bigAlert.fire({
            text: "Correo o contraseña incorrectos!",
            icon: "error"
        });
        break;
    /*Respuesta respuesta para cuando el usuario a sido baneado */
    case "user_ban":
        bigAlert.fire({
            text: "El usuario ingresado se encuentra baneado!",
            icon: "error"
        });
        break;
    /*Respuesta para cuando el correo ingresado en el resgiter ya este registrado */
    case "registered_mail":
        bigAlert.fire({
            text: "El correo electronico ingresado ya se encuentra registrado, intente usar un correo diferente",
            icon: "info"
        });
        break;
     /*Respuesta para cuando un usuario publicista se a guardo correctamente */
    case "user_insert":
        bigAlert.fire({
            confirmButtonColor: "#27a027",
            text: "Usuario registrado correctamente!",
            icon: "success"
        });
    break;
    /*Respuesta para cuando expire la sesion por inactividad*/
    case "loguot":
        Toast.fire({
            
            icon: "info",
            title: "Sesión cerrada por inacividad"
        });
        break;
    /*Respuesta para cuando el usuario necesite verificarse */
    case "set_verify":
        document.getElementById('messageAlert').textContent = "Introdusca el código de verifación enviado a su correo electronico" ;
        document.getElementById('sendEmail').textContent = 'Reenviar Correo' ;
    break;
    /*Respuesta para cuando un usuario no validado intente cambiar su contraseña */
    case "account_verification":
        const email = document.getElementById('sendEmail').getAttribute('email') ;
        document.getElementById('messageAlert').innerHTML = "El usuario ingresado no esta verificado, por favor verifique su cuenta <br> <a href='index.php?controller=users&action=userVerification&email="+email+"'>Verificar Cuenta</a> ";
        break;
    /*Respuesta para cuando la verificacion se realice correctamente */
    case "success_verifivation":
        bigAlert.fire({
            confirmButtonColor: "#27a027",
            title: "Activacion de cuenta realizada correctamente",
            text: "Felicidades! Ya puedes iniciar sesion",
            icon: "success"
            
        });
        break;
    /*Respuesta para cuando el usuario intente validare otra ves */
    case "valid_verify":
        bigAlert.fire({
            confirmButtonColor: "#27a027",
            title: "Usted ya se encuentra verificado",
            text: "Ingresa a nuestro sitio web y disfruta de las experiencias turisticas que Bitacora Oriental puede ofrecer",
            icon: "info"
        });
        break;
    /*Respuesta para cuando alla un error al verificar al usuario (hash o email invalidos) */
    case "error_verifivation":
        document.getElementById('messageAlert').textContent = 'Error al verificar la cuenta, intente verificar su cuenta nuevamente' ;
        document.getElementById('sendEmail').textContent = 'Enviar codigo' ;
        break;
    /*Respuesta para cuando el correo de recuperacion no esta registrado previamente */
    case "mail_not_found":
        bigAlert.fire({
            text: "El Correo ingresado no se encuentra registrado",
            icon: "error"
        });
        break;
    /*Respuesta para cuando la nueva contraseña sea igual que la anterior */
    case "same_passwords":
        bigAlert.fire({
            
            text: "No pude Ingresar la misma contraseña, por favor ingrese una contraseña diferente",
            icon: "info"
        });
        break;
    /*Respuesta para indicar que el cambio de contraseña fue exitoso */
    case "password_found":
        bigAlert.fire({
            text: "La contraseña a sido restablecida correctamente, intenta iniciar sesión",
            icon: "success"
        });
        break;
    /*Respuesta de cuando se envie el codigo de para cambiar contraseña */
    case "mail_send":
        document.getElementById('messageAlert').textContent = '¿No a resivido el codigo de verificación ?' ;
        document.getElementById('sendEmail').textContent = 'Enviar codigo' ;
        break;
    /*Resouesta para cuando el codigo de verificacion expire */
    case "code_invalid":
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
        Toast.fire({
            
            text: "El codido de veridicacion es invalido, intentelo de nuevo",
            icon: "info"
        });
        document.getElementById('messageAlert').textContent = '¿No a resivido el codigo de verificación ?' ;
        document.getElementById('sendEmail').textContent = 'Enviar codigo' ;
        break 
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
    /*Repuesta para cuando el codigo de verificacion expire */
    case "date_expire":
        Toast.fire({
            
            text: "El codido de veridicacion a expirado, por favor solicite una nuevo",
            icon: "info"
        });
        document.getElementById('messageAlert').textContent = 'El codido de veridicacion a expirado, por favor solicite una nuevo' ;
        document.getElementById('sendEmail').textContent = 'Enviar codigo' ;
        break;
    /*Respusta para cuando no se mande el correo de varificacion de usaurio */
    case "error_send_Verify":
        document.getElementById('messageAlert').textContent = "Error al enviar el codigo de verificacion, intentelo de nuevo" ;
        document.getElementById('sendEmail').textContent = 'Reenviar Correo' ;
        break;
    /*Respuesta de error para cuando no se envie el codigo de verificacion para cambio de contraseña*/
    case "error_send":
        document.getElementById('messageAlert').textContent = "Error al enviar el codigo de verificacion, intentelo de nuevo" ;
        document.getElementById('sendEmail').textContent = 'Reenviar Codigo' ;
        break;
    /*Resouesta para cuando ocurra un error inesperado en la validacion del usuario */
    case "account_verification_error":
        bigAlert.fire({
            title: "Oops!...",
            text: "Ocurrio un error inesperado, contacte al equipo de Bitacora Oriental",
            icon: "warning"
        });
        break;
}
/*envio de mail de verificacion */
const sendEmail = document.getElementById('sendEmail') ? document.getElementById('sendEmail') : null;
if( sendEmail !== null){
    sendEmail.addEventListener('click',function(){
        const email = sendEmail.getAttribute('email');
        /*link para hacer la peticion al servidor */
        let url;
        let action = alert.getAttribute('actionModel') ? alert.getAttribute('actionModel') : null ;
        
        /*condicional para distinguir en que vista se ejecuta el script */
        if(action !== null){
        
        document.getElementById('messageAlert').textContent = '¿No a resivido el codigo de verificación ?' ;
        url = "index.php?controller=users&action=sendCode&email="+email+"&opc="+action;            
        

        forwardMail();// realiza una cuenta regresiva para enviar otro correo
        /*condicion para distenguir que peticion se hara al servidor */
        const hash = document.getElementById('hash');// se extrae el hash
            return fetch(url,{})
            .then(response=>response.json())
                .then( data =>{
                    const text = data.trim();// se capta el JSON y se limpia la cadena de espacios
                    if(data === "error_send"){//en caso de que no se resiva el codigo de verificacion
                        document.getElementById('messageAlert').textContent = "Error al enviar el codigo de verificacion, intentelo de nuevo" ;
                    }else{// si se resive se imprime en el HTML
                        hash.value = text;// se cambia el contedido del hash por el actual
                    }
                    
            })
            .catch(err => console.log(err))

        }
    });
    /*Cuenta regresiva para vover a enviar otro correo */
    function forwardMail(){
        const countdownElement = document.getElementById('countdown');
        sendEmail.textContent = "";
        let timeLeft = 5;// Aqui se agusta el conteo regresivo
        function countdown() {
            countdownElement.textContent = timeLeft;//aqui se muestra la cuenta regresiva en tiemp real
            timeLeft--;
            if (timeLeft <= 0) {//expresion de salida 
                clearInterval(timer);
                countdownElement.textContent = '';
                sendEmail.textContent = 'Reenviar Codigo' ;//menaje final luego del conteo
            }
        }
        const timer = setInterval(countdown, 1000);//aqui se ajusta el tiempo de espera 1000 = 1 Seg
    }
}


