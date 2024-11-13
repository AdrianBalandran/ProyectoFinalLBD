<?php 
    $servername = 'localhost';
    $cuenta = 'root';
    $password = '';
    $bd = 'goodWatch';

    // Conexión a la base de datos 
    $conexion = new mysqli($servername, $cuenta, $password, $bd);

    if ($conexion->connect_errno) {
        die('Error en la conexion');
    }

    if(isset($_POST['busca'])){
        $busca = $_POST["busca"];
    }
    $flagfil = true
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoodWatch | Filmes</title>

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

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>
</head>
<body>
    <header>
        <?php
            include ("encabezado.php");
        ?>
    </header>
    <script src="https://kit.fontawesome.com/f3a304d792.js" crossorigin="anonymous"></script>


    <div class="peliculas-sec">
    <p class="resultado">La búsqueda es: <span class="color"><?php echo $busca ?> </span></p>

        <!-- Colocación de las tarjetas -->
        <div class="colocacion">

            <?php

            function datos($conexion, $busca)
            {
                // $sql = "SELECT FI.NOMBRE NOMBRE, FI.IMAGEN IMAGEN, FI.CLASIFICACION CLASIFICACION, FI.FECHA_ESTRENO FECHA_ESTRENO, P.DURACION DURACION, FI.ID_FILME FROM FILME FI, PELICULA P WHERE FI.ID_FILME = P.ID_FILME;";
                // $sql = "SELECT FI.ID_FILME, FI.TIPO_FILME TIPO, FI.NOMBRE NOMBRE, FI.IMAGEN IMAGEN, FI.CLASIFICACION CLASIFICACION, FI.FECHA_ESTRENO FECHA_ESTRENO FROM FILME FI WHERE LOWER(FI.NOMBRE) = LOWER('$busca');";

                $sql = "SELECT FI.ID_FILME, FI.TIPO_FILME TIPO, FI.NOMBRE NOMBRE, FI.IMAGEN IMAGEN, FI.CLASIFICACION CLASIFICACION, FI.FECHA_ESTRENO FECHA_ESTRENO FROM FILME FI WHERE LOWER(FI.NOMBRE) LIKE CONCAT('%',SUBSTR(LOWER('$busca'), 1, 2),'%') OR LOWER(FI.NOMBRE) LIKE CONCAT('%',LOWER('$busca'),'%') OR  LOWER(FI.NOMBRE) LIKE CONCAT('%',SUBSTR(LOWER('$busca'), 1, 1),'%');";
                $resultado = $conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        $id_peli = $fila['ID_FILME'];
                        if($fila['TIPO'] == 'P'){
                            $sql1 = "SELECT P.DURACION DURACION FROM PELICULA P WHERE '$id_peli' = P.ID_FILME;";
                            $resultado1 = $conexion->query($sql1);
                            while ($fila1 = $resultado1->fetch_assoc()) {
                        // Convertir la fecha al formato DD/MM/YYYY
                        $fechaEstreno = new DateTime($fila['FECHA_ESTRENO']);
                        $fechaFormateada = $fechaEstreno->format('d/m/Y');
            ?>         
            <form action="Info_Peliculas.php" method="POST" id="formulario" class="form1">
                        <button name="submit" type="submit" value="<?php echo $fila['ID_FILME']; ?>">
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
                                        <h5 class="card-title"><?php echo $fila1['DURACION'] ?> min.</h5>
                                    </div>
                                </div>
                            </div>                       
                        </button>
                        </form>
                        <?php

                            }
                        }else if($fila['TIPO'] == 'S'){
                            $sql1 = "SELECT S.FECHA_ESTRENO FECHA_ESTRENO, S.NUMERO_EPISODIOS EPISODIOS, S.TEMPORADA TEMPORADA, S.IMAGENTEM FROM SERIE S WHERE '$id_peli' = S.ID_FILME;";
                            $resultado1 = $conexion->query($sql1);
                            while ($fila1 = $resultado1->fetch_assoc()) {
                                // Convertir la fecha al formato DD/MM/YYYY
                                $fechaEstreno = new DateTime($fila1['FECHA_ESTRENO']);
                                $fechaFormateada = $fechaEstreno->format('d/m/Y');?>
                                <form action="Info_Series.php" method="POST" id="formulario" class="form1">
                                <button name="submit" type="submit" value="<?php echo $fila['ID_FILME']; ?>+<?php echo $fila1['TEMPORADA']; ?>">
                                    <div class="card-sep">
                                        <div class="card border-dark mb-3 card-size">
                                            <img src="../imagenes/<?php echo $fila1['IMAGENTEM'] ?>" class="card-img-top" alt="Imagen de película">
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
                                                    <h4>TEMPORADA <?php echo $fila1['TEMPORADA'] ?></h4>
                                                <h4><?php echo $fila1['EPISODIOS'] ?> EPISODIOS</h4>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </button>
                                </form>

                        <?php
                            }
                        }
                    }
                } else { 
                    $flagfil = false;
                    $GLOBALS["flagfil"] = false; 
                }
            }
            ?>
            <?php
            // Llamada a la función para mostrar los datos
            datos($conexion, $busca);
            ?>
        </div>
        <?php 
        if($flagfil == false){ ?>
            <!-- <p class="resultado">No se han encontrado filmes</p> -->
            <div class="loader">
            <div class="circle">
                <div class="dot"></div>
                <div class="outline"></div>
            </div>
            <div class="circle">
                <div class="dot"></div>
                <div class="outline"></div>
            </div>
            <div class="circle">
                <div class="dot"></div>
                <div class="outline"></div>
            </div>
            <div class="circle">
                <div class="dot"></div>
                <div class="outline"></div>
            </div>
            </div>
        <?php }
        ?>
    </div>

</body>
<?php include "footer.php";?>
</html>