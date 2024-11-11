<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoodWatch | Series</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="../css/series.css">
    <link rel="stylesheet" href="../css/encabezado.css">

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

    <header>
        <?php
            include ("encabezado.php");
        ?>
    </header>

    <div class="peliculas-sec">
        <form action="Info_Series.php" method="POST" id="formulario" class="form">
        <!-- Colocación de las tarjetas -->
        <div class="colocacion">

            <?php
            $servername = 'localhost:3306';
            $cuenta = 'root';
            $password = '';
            $bd = 'goodWatch';

            // Conexión a la base de datos 
            $conexion = new mysqli($servername, $cuenta, $password, $bd);

            if ($conexion->connect_errno) {
                die('Error en la conexion');
            }
            session_start();

            function datos($conexion)
            {
                $sql = "SELECT FI.NOMBRE NOMBRE, S.IMAGENTEM IMAGEN, FI.CLASIFICACION CLASIFICACION, S.FECHA_ESTRENO FECHA_ESTRENO, S.NUMERO_EPISODIOS EPISODIOS, S.TEMPORADA TEMPORADA, FI.ID_FILME FROM FILME FI, SERIE S WHERE FI.ID_FILME = S.ID_FILME;";
                $resultado = $conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        // Convertir la fecha al formato DD/MM/YYYY
                        $fechaEstreno = new DateTime($fila['FECHA_ESTRENO']);
                        $fechaFormateada = $fechaEstreno->format('d/m/Y');
                        
            ?>
                    <button name="submit" type="submit" value="<?php echo $fila['ID_FILME']; ?>+<?php echo $fila['TEMPORADA']; ?>">
                        <div class="card-sep">
                            <div class="card border-dark mb-3 card-size">
                                <img src="../imagenes/<?php echo $fila['IMAGEN'] ?>" class="card-img-top" alt="Imagen de película">
                                <div class="card-body nbcolor d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title"><?php echo $fila['NOMBRE'] ?></h5>
                                        <!-- Mostrar la fecha en formato DD/MM/YYYY -->
                                        <h4><?php echo $fechaFormateada ?></h4>
                                        <div class="npcolor">
                                            <p class="card-text"><?php echo $fila['CLASIFICACION'] ?></p>
                                        </div>
                                    </div>
                                    <div class="infoserie">
                                        <h4>TEMPORADA <?php echo $fila['TEMPORADA'] ?></h4>
                                    <h4><?php echo $fila['EPISODIOS'] ?> EPISODIOS</h4>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </button>

            <?php
                    }
                } else {
                    echo "<p>No se encontraron series.</p>";
                }
            }

            // Llamada a la función para mostrar los datos
            datos($conexion);
            ?>


        </div>
        </form>
    </div>

</body>

<?php 
    include ("footer.php");
?>
</html>

<?php

if(isset($_SESSION['InsertadaS'])){ 
    unset($_SESSION['InsertadaS'])?>
        <script>
            Swal.fire({
            title: "¡Felicidades!",
            text: "Has acabado una temporada más",
            imageUrl: "../imagenes/<?php echo $_SESSION['imagen'] ?>",
            imageWidth: 200,
            imageAlt: "Serie"
            });      
        </script>
        <?php
    }
?>