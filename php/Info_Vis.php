<?php
session_start();

$servidor='localhost';
$cuenta='root';
$password='';
$bd='GOODWATCH';

//conexion a la base de datos
$conexion = new mysqli($servidor, $cuenta, $password, $bd);

if($conexion->connect_errno) {
    die('Error en la conexion');
}else{
    if(isset($_POST['submit']) && isset($_SESSION['usuario'])){
        $id = $_POST["submit"];
        echo $stri; 
    }else{
        echo "no hay persona registrada.";
        header(header: "Location: ../index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>

    <?php 
        $sql = "SELECT NOMBRE, TEMPORADA FROM FILMEVISTA WHERE ID_VISUALIZACION = '$id';";
        $resultado = $conexion -> query($sql);
        while( $fila = $resultado -> fetch_assoc() ){?>
            <title>GoodWatch | <?php echo $fila['NOMBRE']; if($fila['TEMPORADA'] != NULL) echo " T.", $fila['TEMPORADA']; ?></title>
        <?php
        }

    ?>
        
    <link rel="stylesheet" href="../css/misvisual.css">
    <link rel="stylesheet" href="../css/encabezado.css">


    <!-- Letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Itim&display=swap" rel="stylesheet">
    <header>
        <?php
            include ("encabezado.php");
        ?>
    </header>
<body class="containertarjetas"></body>
