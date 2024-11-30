<?php
$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'GOODWATCH';

$conexion = new mysqli($servidor, $cuenta, $password, $bd);

// Verificar si la conexión fue exitosa
if ($conexion->connect_errno) {
    die('Error en la conexión: ' . $conexion->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoodWatch | Inicio</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../ProyectoFinalLBD/imagenes/faviconi.png"/>

</head>
<body>
    <header>
        <?php
            include ("encabezado.php");
        ?>
    </header>

    <section class="header">
        <h2>TU BÚSQUEDA DEL ENTRETENIMIENTO<br>PERFECTO COMIENZA AQUÍ</h2>
    </section>

    <section class="tendencias">
        <div class="tendencia">
            <h3>Películas Mejor Calificadas</h3>
        </div>

        <div class="peliculas">
            <?php
            // Consulta para obtener películas con calificación mayor a 9 desde la vista
            $sql = "SELECT * FROM peliculas_mayores_9;";
            $resultado = $conexion->query($sql);

            // Verificar si hay resultados
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    // Mostrar las películas con calificación mayor a 9
                    ?>
                    <div class="pelicula">
                        <div class="imagen">
                            <img src="imagenes/<?php echo $fila['IMAGEN']; ?>" alt="<?php echo $fila['pelicula']; ?>">
                        </div>
                        <div class="detalle">
                            <h3><?php echo $fila['pelicula']; ?></h3> <!-- Nombre de la película -->
                            <p>Calificación Promedio: <?php echo number_format($fila['CALIFICACION_PROMEDIO'], 1); ?> ⭐</p> <!-- Promedio de calificación -->
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p style='color: #656565;'>No hay películas con calificación mayor a 9.</p>";
            }
            ?>
        </div>

        <div class="tendencia">
            <h3>Series Mejor Calificadas</h3>
        </div>
        <div class="series">
            <?php
            // Consulta para obtener series con calificación mayor a 9 desde la vista
            $sql = "SELECT * FROM series_mayores_9;";
            $resultado = $conexion->query($sql);

            // Verificar si hay resultados
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    // Mostrar las series con calificación mayor a 9
                    ?>
                    <div class="serie">
                        <div class="imagen">
                            <img src="imagenes/<?php echo $fila['IMAGEN']; ?>" alt="<?php echo $fila['serie']; ?>">
                        </div>
                        <div class="detalle">
                            <h3><?php echo $fila['serie']; ?></h3> <!-- Nombre de la serie -->
                            <p>Calificación Promedio: <?php echo number_format($fila['CALIFICACION_PROMEDIO'], 1); ?> ⭐</p> <!-- Promedio de calificación -->
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p style='color: #656565;'>No hay series con calificación mayor a 9.</p>";
            }
            ?>
        </div>

        <div class="tendencia">
            <h3>Nuevos Lanzamientos</h3>
        </div>
        <div class="nuevos-lanzamientos">
            <?php
            // Consulta para obtener los nuevos lanzamientos
            $sql = "SELECT tipo, titulo, IMAGEN, FECHA_ESTRENO FROM nuevos_lanzamientos ORDER BY FECHA_ESTRENO DESC";
            $resultado = $conexion->query($sql);

            // Verificar si hay resultados
            if ($resultado->num_rows > 0) {
                // Mostrar los resultados
                while ($fila = $resultado->fetch_assoc()) {
                    ?>
                    <div class="nuevos-lanzamientos-item">
                        <div class="imagen">
                            <img src="imagenes/<?php echo $fila['IMAGEN']; ?>" alt="<?php echo $fila['titulo']; ?>">
                        </div>
                        <div class="detalle">
                            <h3><?php echo $fila['titulo']; ?></h3> <!-- Título del lanzamiento -->
                            <p><strong>Fecha de estreno:</strong> <?php echo date('d M Y', strtotime($fila['FECHA_ESTRENO'])); ?></p>
                            <p><strong>Tipo:</strong> <?php echo $fila['tipo']; ?></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p style='color: #656565;'>No hay nuevos lanzamientos disponibles.</p>";
            }
            ?>
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
                        <p class="carousel-classification">B</p>
                        <img class="carousel-platform" src="imagenes/Cinepolis.jpg" alt="">
                        <p class="carousel-text">Coming Soon...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="categorias">
        <div class="row">
            <div class="col-5">
                <h1>Categorías Populares</h1>
                <p>Desde emocionantes aventuras y conmovedoras historias hasta intrigantes thrillers y románticas comedias, aquí encontrarás contenido para todos los gustos.</p>
            </div>
            <div class="col-7">
                <div class="row">
                    <div class="col-4">
                        <div class="box" style="background-image: url('imagenes/accion.jpg');">
                            <div class="box-content">Acción</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box" style="background-image: url('imagenes/ciencia-ficcion.jpg');">
                            <div class="box-content">Ciencia Ficción</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box" style="background-image: url('imagenes/terror.jpg');">
                            <div class="box-content">Terror</div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <div class="box" style="background-image: url('imagenes/romance.jpg');">
                            <div class="box-content">Romance</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box" style="background-image: url('imagenes/comedia.jpg');">
                            <div class="box-content">Comedia</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box" style="background-image: url('imagenes/aventura.jpg');">
                            <div class="box-content">Aventura</div>
                        </div>
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

<?php 
    include ("footer.php");
?>
</html>

<?php 

    if(isset($_SESSION['logout'])){
        ?>
        <script>
            Swal.fire({
            icon: "success",
            title: "Abandonarás tu sesión",
            text: "¡Has cerrado sesión de tu cuenta!",
            })
        </script>
        <?php 
        unset($_SESSION['logout']);
        unset($_SESSION['captcha']);
        unset($_SESSION['intentos']);
    }

    $conexion->close();
?>
