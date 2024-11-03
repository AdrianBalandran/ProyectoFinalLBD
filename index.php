<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoodWatchs</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <?php
            include ("php/encabezado.php");
        ?>
    </header>

    <section class="header">
        <h2>TU BÚSQUEDA DEL ENTRETENIMIENTO<br>PERFECTO COMIENZA AQUÍ</h2>
    </section>

    <section class="tendencias">
        <div class="tendencia">
            <h3>Tendencias en Películas</h3>
            <a href="#" class="ver-todo">Ver Todo<i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="tendencia">
            <h3>Tendencias en Series</h3>
            <a href="#" class="ver-todo">Ver Todo<i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="tendencia">
            <h3>Nuevos Lanzamientos</h3>
            <a href="#" class="ver-todo">Ver Todo<i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </section>

    <section class="proximamente">
        <div id="carouselExample" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <div class="overlay"></div>
                    <img src="imagenes/TLOU2.jpeg" class="d-block w-100" alt="Película 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-title">THE LAST OF US TEMPORADA 2</h1>
                        <p class="carousel-genero">Drama, Thriller Postapocalíptico</p>
                        <p class="carousel-classification">TV-MA</p>
                        <img class="carousel-platform" src="imagenes/HBO_Max_logo.jpg" alt="">
                        <p class="carousel-text">Coming Soon...</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="imagenes/Arcane2.jpeg" class="d-block w-100" alt="Película 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-title">ARCANE TEMPORADA 2</h1>
                        <p class="carousel-genero">Ciencia Ficción Fantástica, Acción, Aventura y Drama</p>
                        <p class="carousel-classification">TV-14</p>
                        <img class="carousel-platform" src="imagenes/Netflix.png" alt="">
                        <p class="carousel-text">Coming Soon...</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="imagenes/Gladiador2.jpg" class="d-block w-100" alt="Película 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-title">GLADIADOR 2</h1>
                        <p class="carousel-genero">Acción, Aventura, Drama</p>
                        <p class="carousel-classification">R</p>
                        <img class="carousel-platform" src="imagenes/Cinepolis.jpg" alt="">
                        <p class="carousel-text">Coming Soon...</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="imagenes/minecraft.jpg" class="d-block w-100" alt="Película 4">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="carousel-title">MINECRAFT MOVIE</h1>
                        <p class="carousel-genero">Comedia, Acción, Aventura, Fantasía</p>
                        <p class="carousel-classification">R</p>
                        <img class="carousel-platform" src="imagenes/Cinepolis.jpg" alt="">
                        <p class="carousel-text">Coming Soon...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f3a304d792.js" crossorigin="anonymous"></script>
    <script src="js/carrusel.js"></script>
</body>
</html>