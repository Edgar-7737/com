
const alert = document.getElementById('alert');
const nameAlert = alert.getAttribute('nameAlert');
const modelAlert = alert.getAttribute('modelAlert');


const bigAlert = Swal.mixin({
    confirmButtonColor: "#27a027",
    cancelButtonColor: "#808180",
    timer: 3000,
    width: "25em",
    padding: "1em",   
});

const Toast = Swal.mixin({
    toast: true,
    showConfirmButton: false,
    timerProgressBar: true,
    didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
    }
});


////////////////////////////////Respuestas previas antes del envio del formulario

let editCheck = {ok:true};
const edit = document.getElementById("edit") ? document.getElementById("edit") : null ;
if(edit !== null ){
    document.addEventListener('DOMContentLoaded', (event) => {
        const form = document.querySelector('form');
        const initialData = new FormData(form);

        form.addEventListener('submit', (event) => {
            if(check.ok){
                // Evita el envío del formulario por defecto
                const currentData = new FormData(form);
                let hasChanged = false;

                for (let [key, value] of initialData.entries()) {
                    if (currentData.get(key) !== value) {
                        hasChanged = true;
                        break;
                    }
                }
                if (hasChanged) {
                        event.preventDefault();
                        bigAlert.fire({
                            title: "¿Quieres guardar los cambios?",
                            showDenyButton: true,
                            denyButtonColor: "#808180",
                            confirmButtonText: "Guardar",
                            denyButtonText: `No guardar`,
                            timer: undefined,
                        }).then((result) => {                            
                            if (result.isConfirmed) {
                                const url = form.action;
                                send(url,currentData);
                            } else if (result.isDenied) {
                                editCheck.ok= false;
                            bigAlert.fire("", "Los cambios no se guardaron", "info");
                            }
                        });
                } else {
                    
                    Toast.fire({
                        position: "bottom",
                        timer: 3000,
                        icon: "info",
                        title: "No se han realizado cambios en el formulario"
                    });
                    
                    event.preventDefault();
                }
            }
        });
    });
}else{
    document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            
            forms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    if(check.ok === true){
                        event.preventDefault(); // Evita el envío normal del formulario
                        
                        const url = form.action;
                        const formData = new FormData(form);
        
                        fetch(url, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.text())
                        .then(data => {
                            switchAlert(data.trim());
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            });
                    }
                });
            });
    });
}


function send(url, formData){
    console.log("en la fucnion");

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        switchAlert(data.trim());
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////Envio de formularios 
/* document.addEventListener('DOMContentLoaded', function() {
    console.log("dontro del fetch");
    if(check.ok && editCheck.ok){
        const form = document.querySelector('form');
        console.log("dontro de la conficion del fetch");
        
                const url = form.action;
                const formData = new FormData(form);

                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    switchAlert(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
         
    }
}); */

// mapa de alertas para las respuestas del servidor
function switchAlert(valueAlert){
    console.log(valueAlert);
    
    const mapAlert = {
        packagessave: "Paquete de viaje guardado correctamente!",
        packagesupdate: "Paquete de viaje actualizado correctamente!",
        packagesduplicate: "El paquete de viaje ingresado ya se encuentra registrado",
        packagesduplicate_edition: "El paquete de viaje editado coincide con uno ya existente",
        packagesdisabled_not_allowed: "El paquete de viaje" ,
    
    
        routesave:"Ruta de viaje guardada correctamente!" ,
        routeupdate: "Ruta de viaje actualizada correctamente!",
        routeduplicate: "La Ruta de viaje ingresada ya se encuentra registrada",
        routeduplicate_edition: "La ruta de viaje editada coincide con una ya existente",
        routedisabled_not_allowed: "La ruta de viaje",
    }

    switch(valueAlert){
        case "save" :
            bigAlert.fire({
                text: mapAlert[modelAlert + valueAlert],
                icon: "success",
            });
            break;
        case "update" :
            bigAlert.fire({
                text: mapAlert[modelAlert + valueAlert],
                icon: "success",
                
            });
            break;
        case "duplicate" :
        bigAlert.fire({
            text: mapAlert[modelAlert + valueAlert],
            icon: "info",
            confirmButtonColor: "#808180",
                
        });
        break;
        case "duplicate_edition" :
            bigAlert.fire({
                html: mapAlert[modelAlert + valueAlert],
                icon: "info",
                confirmButtonColor: "#808180",
            });
        break;
        case "edited_user":
            bigAlert.fire({
                text: "El usuario a sido editado correctamente",
                icon: "success"
            });
        break;
            
        case "disabled_not_allowed":
            Toast.fire({
                position: "top-end",
                timer: 3000,
                text: `${mapAlert[modelAlert + valueAlert]} no se puede inhabilitar por que esta siendo usado en una oferta de viaje`,
                icon: "info"
            });
        break;
    }

}


/////////////////////////// alerta para las reservaciones
if(nameAlert === 'false'){
    const url = "index.php?controller=packages&action=count";
            fetch(url,{})
                .then(response=>response.text())
                    .then( data =>{
                        const text = data.trim();
                        if( text === "pending_reservations"){
                            Toast.fire({
                                position: "top-end",
                                timer: 7000,
                                icon: "info",
                                title: "Tiene solicitudes de reservaciones pendientes",
                                footer: '<a href="index.php?controller=packages&action=list">Ver reservaciones</a>',
                            });
                        }
                })
        .catch(err => console.log(err))
}
