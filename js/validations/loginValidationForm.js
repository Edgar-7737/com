//depurar con console.log

const regexMAX ={
    email : 50 ,
    password : 16
};

document.querySelectorAll('input').forEach(input => {
   input.addEventListener('keypress', function(e) {
       const inputField = e.target; 
       if (inputField.value.length >= regexMAX[input.name]){
           e.preventDefault();
           return;
       }else{
        document.getElementById('errorMessage' + input.id).textContent = "";
       }
   });
});

document.getElementById('loginForm').addEventListener('submit',function( event){
    const input = document.querySelectorAll('input');
    for (const data of input){
        if (data.value.trim() === '') {
            document.getElementById('errorMessage' + data.id).textContent = `No debe estar vacio`;
            data.focus();
            event.preventDefault();
            return;
        }
    }
});
