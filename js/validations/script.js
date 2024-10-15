const form = document.getElementById('form');
const inputs = document.querySelectorAll('#form input');

const expresiones = {
	query: /^[a-zA-Z0-9\¿\?\s\ñ]+$/, // Letras, numeros y algunos caracteres especiales 
	respond: /^[a-zA-Z0-9\¿\?\s\ñ]+$/, // Letras y espacios, pueden llevar acentos.
}

const campos = {
	query: false,
	respond: false,
}

const validarform = (e) => {
	switch (e.target.name) {
		case "query":
			validarCampo(expresiones.query, e.target, 'query');
		break;
		case "respond":
			validarCampo(expresiones.respond, e.target, 'respond');
		break;
	}
}

const validarCampo = (expresion, input, campo) => {
	if(input.value.length > 0 && expresion.test(input.value)){
		document.getElementById(`group__${campo}`).classList.remove('form__group-incorrect');
		document.getElementById(`group__${campo}`).classList.add('form__group-correct');
		document.querySelector(`#group__${campo} .form__input-error`).classList.remove('form__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`group__${campo}`).classList.add('form__group-incorrect');
		document.getElementById(`group__${campo}`).classList.remove('form__group-correct');
		document.querySelector(`#group__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#group__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#group__${campo} .form__input-error`).classList.add('form__input-error-activo');
		campos[campo] = false;
	}
}


inputs.forEach((input) => {
	input.addEventListener('keyup', validarform);
	input.addEventListener('blur', validarform);
});

form.addEventListener('submit', (e) => {
	
	if(!(campos.query && campos.respond)){
	e.preventDefault();

	/* esta parte valida cuantos campos tiene que estar corrects para que se pueda enviar */
	
	document.getElementById('form__message').classList.add('form__message-activo');
	setTimeout(() => {
		document.getElementById('form__message').classList.remove('form__message-activo');
	},5000);
	
	
} else {
	/* form.reset(); */
	document.getElementById('form__message').classList.remove('form__message-activo');
	document.getElementById('form__message-success').classList.add('form__message-success-activo');
	}
});