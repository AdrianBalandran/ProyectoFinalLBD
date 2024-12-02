<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoodWatch | Ver Todo</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="../css/peliculas.css">
    <link rel="stylesheet" href="../css/vertodo.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Fuentes de letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://kit.fontawesome.com/f3a304d792.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Encabezado -->
    <header>
        <?php
            include ("encabezado.php");
        ?>
    </header>

    <div class="contpeliseries">
        <!-- Aquí muestro el total de películas y series -->
        <?php
            $servername = 'localhost';
            $cuenta = 'root';
            $password = '';
            $bd = 'goodWatch';

            // Conexión a la base de datos
            $conexion = new mysqli($servername, $cuenta, $password, $bd);

            if ($conexion->connect_errno) {
                die('Error en la conexión');
            }

            // Consulta para contar películas y series
            $consulta = "
                SELECT 
                    (SELECT COUNT(*) FROM PELICULA) AS total_peliculas,
                    (SELECT COUNT(*) FROM SERIE) AS total_series
            ";

            $resultado = $conexion->query($consulta);
            if ($resultado->num_rows > 0) {
                $conteo = $resultado->fetch_assoc();
                $totalPeliculas = $conteo['total_peliculas'];
                $totalSeries = $conteo['total_series'];

                echo "<h3>Películas </h3> <p>$totalPeliculas</p>";
                echo "<h3>Series </h3> <p> $totalSeries</p>";
            } else {
                echo "<p>No se pudo obtener el conteo de películas y series.</p>";
            }
        ?>
    </div>

    <!-- Contenido que muestra películas y series -->
    <div class="peliculas-sec">
        <form action="Info_Peliculas.php" method="POST" id="formulario" class="form">
            <div class="colocacion">
                <?php
                function datos($conexion)
                {
                    $sql = "
                    SELECT FI.NOMBRE, FI.IMAGEN, FI.CLASIFICACION, FI.FECHA_ESTRENO, P.DURACION AS DURACION_O_EPISODIOS, NULL AS TEMPORADA
                    FROM FILME FI
                    JOIN PELICULA P ON FI.ID_FILME = P.ID_FILME
                    UNION
                    SELECT FI.NOMBRE, S.IMAGENTEM AS IMAGEN, FI.CLASIFICACION, S.FECHA_ESTRENO, S.NUMERO_EPISODIOS AS DURACION_O_EPISODIOS, S.TEMPORADA
                    FROM FILME FI
                    JOIN SERIE S ON FI.ID_FILME = S.ID_FILME
                    ORDER BY FECHA_ESTRENO ASC;"; // Cambiar a DESC para orden descendente

                    $resultado = $conexion->query($sql);
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            // Convertir la fecha al formato DD/MM/YYYY
                            $fechaEstreno = new DateTime($fila['FECHA_ESTRENO']);
                            $fechaFormateada = $fechaEstreno->format('d/m/Y');
                            $extraInfo = $fila['TEMPORADA'] ? "TEMPORADA {$fila['TEMPORADA']}" : "{$fila['DURACION_O_EPISODIOS']} min.";
                ?>
                            <button name="submit" type="submit" value="<?php echo $fila['NOMBRE']; ?>">
                                <div class="card-sep">
                                    <div class="card border-dark mb-3 card-size">
                                        <img src="../imagenes/<?php echo $fila['IMAGEN'] ?>" class="card-img-top" alt="Imagen">
                                        <div class="card-body nbcolor d-flex flex-column justify-content-between">
                                            <div>
                                                <h5 class="card-title"><?php echo $fila['NOMBRE'] ?></h5>
                                                <h4><?php echo $fechaFormateada ?></h4>
                                                <div class="npcolor">
                                                    <p class="card-text"><?php echo $fila['CLASIFICACION'] ?></p>
                                                </div>
                                            </div>
                                            <h5 class="card-title"><?php echo $extraInfo ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </button>
                <?php
                        }
                    } else {
                        echo "<p>No se encontraron filmes.</p>";
                    }
                }

                // Llamada a la función para mostrar los datos
                datos($conexion);
                ?>
            </div>
        </form>
    </div>

    <!-- Pie de página -->
    <footer>
        <?php
        include ("footer.php");
        ?>
    </footer>
</body>
</html>
