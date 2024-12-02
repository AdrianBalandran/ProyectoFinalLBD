<?php
session_start();

date_default_timezone_set('America/Mexico_City');


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
        if($_SESSION['usuario'] != "Admin"){
            $id = $_POST["submit"];
        }else{
            header(header: "Location: ../index.php");
        }
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
    <link rel="stylesheet" href="../css/info.css">


    <!-- Letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Itim&display=swap" rel="stylesheet">
    <header>
        <?php
            include ("encabezado.php");
        ?>
    </header>
</head>
<body class="info_visphp">
    <section class="info" id="info">
    <div class="info_filme">
        <div class="primer">
        <?php 
                $sql = "SELECT * FROM FILMEVISTA WHERE ID_VISUALIZACION = '$id';";
                $resultado = $conexion -> query($sql);
                while( $fila = $resultado -> fetch_assoc() ){ 
                    $filme = $fila['ID_FILME']; 
                    $serie = $fila['TEMPORADA']; 
                    $visu = $fila['ID_VISUALIZACION']; 
                    ?>
                    <div class="tarjeta" name="submit" type="submit" value="<?php echo $visu;?>">
                        <div class="imagenF"> <?php
                            if($fila['TIPO_FILME'] == 'S'){ 
                                    $imagen = "SELECT IMAGENTEM FROM SERIE WHERE ID_FILME = '$filme' AND TEMPORADA = '$serie';";
                                    $resultado1 = $conexion -> query($imagen);
                                    while( $fila1 = $resultado1 -> fetch_assoc() ){ 
                                        ?>
                                        <img src="../imagenes/<?php echo $fila1['IMAGENTEM'] ?>" alt="" class="pel">
                                    <?php }
                                }else {
                                ?>
                                    <img src="../imagenes/<?php echo $fila['IMAGEN'] ?>" alt="" class="pel">
                                <?php
                                }
                            ?>
                        </div>
                        <div class="estrellasF estreInfoVis"> <?php 
                            for ($i = 1; $i <= (int)$fila['CALIFICACION']; $i++) { ?>
                                <img src="../imagenes/recursos/start.png" alt="Estrellas">
                            <?php }
                            $num = (float)$fila['CALIFICACION'] - (int)$fila['CALIFICACION']; 
                            $num = (float)$num;
                            $num = strval($num); 
                            if($num >= 0.1 && $num <= 0.2){ ?>
                                <img src="../imagenes/recursos/start2.png" alt="Estrellas" class="star">
                            <?php }else if($num >= 0.3 && $num <= 0.4){
                                ?>
                                <img src="../imagenes/recursos/start4.png" alt="Estrellas" class="star">
                                <?php
                            }else if($num == 0.5){
                                ?>
                                <img src="../imagenes/recursos/startmedia.png" alt="Estrellas" class="star">
                                <?php
                            }else if($num >= 0.6 && $num <= 0.7){
                                ?>
                                <img src="../imagenes/recursos/start6.png" alt="Estrellas" class="star">
                                <?php
                            }else if($num >= 0.8 && $num <= 0.9){
                                ?>
                                <img src="../imagenes/recursos/start8.png" alt="Estrellas" class="star">
                                <?php
                            }?>
                        </div>
                        <div class="tipo">
                            <p><?php echo $fila['TIPO_FILME'];?></p>
                        </div>
                        <div class="nombre">
                            <p><?php echo $fila['NOMBRE']; if($fila['TEMPORADA'] != NULL) echo " T.",$fila['TEMPORADA'];?></p>
                        </div>
                        <?php 
                        if($fila['FAVORITO'] == 'S'){ ?>
                            <div class="favorito">
                                <img src="../imagenes/recursos/red.png" alt="">
                            </div>
                        <?php }
                        ?>
                        
                    </div>
                <?php }
            ?>

        </div>

        <div class="segundo">
            <div class="peliculaDatos"> <?php
            $sql = "SELECT V.*, P.NOMBRE PLA, I.NOMBRE IDO FROM VISUALIZACION V, PLATAFORMA P, IDIOMA I WHERE V.ID_VISUALIZACION = '$id' AND P.ID_PLAT = V.ID_PLATAFORMA AND I.ID_IDIOMA = V.ID_IDIOMA;";
            $resultado = $conexion -> query($sql);
            while( $fila = $resultado -> fetch_assoc() ){ ?>
                <div class="desc divcont">
                    <div class="backg">
                        <p>Opinión:</p>
                    </div>
                    <div class="backginfo">
                        <p><?php echo $fila['OPINION'] ?></p>
                    </div>
                </div>
                <div class="estreno divcont">
                    <div class="backg">
                        <p>Fecha:</p>
                    </div>
                    <div class="backg colorwhite">
                        <p><?php echo $fila['FECHA_VISUALIZACION'] ?></p>
                    </div>
                </div>
                <div class="clasif divcont">
                    <div class="backg">
                        <p>Idioma:</p>
                    </div>
                    <div class="backg colorwhite">
                        <p><?php echo $fila['IDO'] ?></p>
                    </div>
                </div>
                <div class="idioma divcont">
                    <div class="backg">
                        <p>Plataforma:</p>
                    </div>
                    <div class="backg colorwhite">
                        <p><?php echo $fila['PLA'] ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>
    </section>
</body>

<footer>
<?php
    include ("footer.php");
?>
</footer>

</html>