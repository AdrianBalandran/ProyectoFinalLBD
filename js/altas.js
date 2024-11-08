function mostrarImagen(event, id) {
    var archivo = event.target.files[0];
    var lector = new FileReader();

    lector.onload = function(e) {
        if(id==1){
            var imagen = document.getElementById('imagen');
        } else if(id==2){
            var imagen = document.getElementById('imagen2');
        } else if(id==3){
            var imagen = document.getElementById('imagen3');
        }
    
    imagen.src = e.target.result;
    imagen.style.display = 'block';
    }

    lector.readAsDataURL(archivo);
}



$(document).ready(function() {
    console.log($('#formulario-pelicula').length);

    $("#formulario-pelicula").on("submit", function(event) {
        console.log("Formulario enviado");
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "altasP.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                console.log("Solicitud AJAX exitosa");
                console.log(response);
                Swal.fire({
                    title: 'Exito',
                    text: 'Pelicula agregada',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                        document.getElementById("formulario-pelicula").reset();
                        location.reload();
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
});


