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


$(document).ready(function() {
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
    $("#formulario-serie").on("submit", function(event) {
        console.log("Formulario serie enviado");
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "altasS.php",
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
                    text: 'Serie agregada',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                        document.getElementById("formulario-serie").reset();
                        location.reload();
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
    $("#formulario-temporada").on("submit", function(event) {
        console.log("Formulario temporada enviado");
        event.preventDefault();

        var formData = new FormData(this);
        console.log(formData);

        $.ajax({
            url: "altasT.php",
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
                    text: 'Temporada agregada',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                        document.getElementById("formulario-temporada").reset();
                        location.reload();
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
    $("#formulario-reparto").on("submit", function(event) {
        console.log("Formulario reparto enviado");
        event.preventDefault();

        var formData = new FormData(this);
        console.log(formData);

        $.ajax({
            url: "altasR.php",
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
                    text: 'Reparto agregado',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                        document.getElementById("formulario-reparto").reset();
                        location.reload();
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
    $("#formulario-repartoFilme").on("submit", function(event) {
        console.log("Formulario repartoFilme enviado");
        event.preventDefault();

        var formData = new FormData(this);
        console.log(formData);

        $.ajax({
            url: "altasR.php",
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
                    text: 'Reparto vinculado',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                        document.getElementById("formulario-repartoFilme").reset();
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


