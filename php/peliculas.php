<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoodWatchn | Peliculas</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="../css/peliculas.css">
    <link rel="stylesheet" href="../css/encabezado.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Fuentes de letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <?php
        include("../php/encabezado.php");
        ?>
    </header>

    <section>
        <div class="peliculas-sec">

            <!-- Carta de datos de pelicula -->
             <div class="card-sep">
             <div class="card" style="width: 18rem;">
                <img src="../imagenes/rapidosyfuriosos2.jpg" class="card-img-top" alt="..." width="auto" height="250px">
                <div class="card-body nbcolor">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Clasificación</p>
                  
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
             </div>
        </div>
    </section>





</body>

</html>