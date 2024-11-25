<?php 
session_start();
date_default_timezone_set('America/Mexico_City');

$nombre = "";
function datos($conexion){
    $sql = "SELECT ";
    $resultado = $conexion -> query($sql);
    while( $fila = $resultado -> fetch_assoc() ){
        $nombre = $fila['NOMBRE'];
        ?>
<?php }
}

$servidor='localhost';
$cuenta='root';
$password='';
$bd='GOODWATCH';

//conexion a la base de datos
$conexion = new mysqli($servidor, $cuenta, $password, $bd);

if($conexion->connect_errno) {
    die('Error en la conexion');
}
if(!isset($_SESSION['usuario'])){
    echo "no hay persona registrada.";
    header(header: "Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>

        
    <title>GoodWatch | Mis vistos</title>
        
    <link rel="stylesheet" href="../css/misvisual.css">

    <!-- Letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Itim&display=swap" rel="stylesheet">
    <header>
        <?php
            include ("encabezado.php");
        ?>
    </header>
<body class="containertarjetas">
    <form action="">
        <section class="datos" id="datos">
            <button class="tarjeta">
                <div class="imagen">
                    <img src="../imagenes/emma.jpg" alt="" class="pel">
                </div>
                <div class="estrellas">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                </div>
                <div class="tipo">
                    <p>P</p>
                </div>
                <div class="nombre">
                    <p>Emma</p>
                </div>
                <div class="favorito">
                    <img src="../imagenes/recursos/red.png" alt="">
                </div>
            </button>

            <button class="tarjeta">
                <div class="imagen">
                    <img src="../imagenes/orgullo_y_prejuicio.jpg" alt="" class="pel">
                </div>
                <div class="estrellas">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                </div>
                <div class="tipo">
                    <p>P</p>
                </div>
                <div class="nombre">
                    <p>Orgullo y Prejuicio</p>
                </div>
                <div class="favorito">
                    <img src="../imagenes/recursos/red.png" alt="">
                </div>
            </button>

            <button class="tarjeta">
                <div class="imagen">
                    <img src="../imagenes/mujercitas.jpg" alt="" class="pel">
                </div>
                <div class="estrellas">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                </div>
                <div class="tipo">
                    <p>P</p>
                </div>
                <div class="nombre">
                    <p>Mujercitas</p>
                </div>
                <div class="favorito">
                    <img src="../imagenes/recursos/red.png" alt="">
                </div>
            </button>

            <button class="tarjeta">
                <div class="imagen">
                    <img src="../imagenes/enola.jpg" alt="" class="pel">
                </div>
                <div class="estrellas">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                </div>
                <div class="tipo">
                    <p>P</p>
                </div>
                <div class="nombre">
                    <p>Enola Homes</p>
                </div>
                <div class="favorito">
                    <!-- <img src="../imagenes/recursos/red.png" alt=""> -->
                </div>
            </button>

            <button class="tarjeta">
                <div class="imagen">
                    <img src="../imagenes/persuasion.jpg" alt="" class="pel">
                </div>
                <div class="estrellas">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                    <img src="../imagenes/recursos/start.png" alt="">
                </div>
                <div class="tipo">
                    <p>P</p>
                </div>
                <div class="nombre">
                    <p>Persuasión</p>
                </div>
                <div class="favorito">
                    <!-- <img src="../imagenes/recursos/red.png" alt=""> -->
                </div>
            </button>
        </section>
    </form>

</body>
<?php 
    include "footer.php";
?>

</html>

