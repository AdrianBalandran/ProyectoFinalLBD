function mostrarImagen(event, id) {
    var archivo = event.target.files[0];
    var lector = new FileReader();

    lector.onload = function(e) {
        if(id==1){
            var imagen = document.getElementById('imagenP');
        } else if(id==2){
            var imagen = document.getElementById('imagenS');
        } else if(id==3){
            var imagen = document.getElementById('imagenT');
        }
    
    imagen.src = e.target.result;
    imagen.style.display = 'block';
    }

    lector.readAsDataURL(archivo);
}

