let cropper;

function openCropModal(event) {
    const files = event.target.files;

    if (files && files.length > 0) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const imageToCrop = document.getElementById('imageToCrop');
            imageToCrop.src = e.target.result;

            // Mostrar el modal
            document.getElementById('cropModal').style.display = 'flex';

            // Destruir el cropper existente si existe
            if (cropper) {
                cropper.destroy();
            }

            // Inicializar el cropper
            cropper = new Cropper(imageToCrop, {
                aspectRatio: 500 / 300, // Relación de aspecto fija
                viewMode: 1, // Mantener el área de recorte dentro del área visible
                autoCropArea: 1, // Área de recorte automática
                cropBoxResizable: true, // Permitir redimensionar el área de recorte
                cropBoxMovable: true, // Permitir mover el área de recorte
                ready() {
                    const cropBoxData = {
                        left: (this.container.width - 500) / 2,
                        top: (this.container.height - 300) / 2,
                        width: 500,
                        height: 300,
                    };
                    this.setCropBoxData(cropBoxData);
                },
            });

            // Mostrar el botón de aceptar modificación
            document.getElementById('cropButton').style.display = 'inline-block';
        };
        reader.readAsDataURL(files[0]);
    }
}

// Aceptar modificaciones de recorte
document.getElementById('cropButton').addEventListener('click', () => {
    const canvas = cropper.getCroppedCanvas();
    canvas.toBlob((blob) => {
        // Crear una URL para la imagen recortada
        const croppedImageUrl = URL.createObjectURL(blob);
        
        // Establecer la imagen recortada como fuente para la vista previa
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = croppedImageUrl;
        imagePreview.style.display = 'block'; // Hacer visible la imagen recortada

        // Actualizar el enlace de Lightbox
        const lightboxLink = document.getElementById('lightboxLink');
        lightboxLink.href = croppedImageUrl; // Establecer el href del enlace de Lightbox
        lightboxLink.style.display = 'inline'; // Hacer visible el enlace de Lightbox

        // Cerrar el modal
        document.getElementById('cropModal').style.display = 'none';

        // Limpiar el cropper
        if (cropper) {
            cropper.destroy(); // Limpiar la instancia del cropper
        }

        // Reemplazar el campo de archivo con la imagen recortada
        const imageInput = document.getElementById('image');
        imageInput.value = ''; // Limpiar el valor del campo de archivo
        const imageFile = new File([blob], 'image.png', { type: 'image/png' });
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(imageFile);
        imageInput.files = dataTransfer.files;

        // Enviar el formulario
        const formData = new FormData(document.getElementById('formPubSpecial'));
        fetch('index.php?controller=pubEspecial&action=insert', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            // Manejar la respuesta del servidor
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

// Cerrar el modal
document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('cropModal').style.display = 'none';
    if (cropper) {
        cropper.destroy(); // Limpiar la instancia del cropper
    }
});