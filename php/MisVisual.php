<?php 
include ("encabezado.php");
date_default_timezone_set('America/Mexico_City');
$usuario = $_SESSION['usuario']; 

$nombre = "";
function datos($conexion){
    $usuario = $_SESSION['usuario']; 
    $sql = "SELECT * FROM PELICULAVISTA WHERE ID_USUARIO = (SELECT ID_USUARIO FROM USUARIO WHERE ALIAS = $usuario)";
    $resultado = $conexion -> query($sql);
    while( $fila = $resultado -> fetch_assoc() ){
        
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
}else if(isset($_SESSION['usuario'])){
    if($_SESSION['usuario'] == "Admin"){
        header(header: "Location: ../index.php");
    }
}

$i = 0; 
$peli = "0"; 
$seri = "0"; 
$total = "0"; 
$HORAS = "0";
$anio = "0"; 
$anioREAL = "2024"; 

$sql = "SELECT F.TIPO_FILME TIPO, COUNT(F.TIPO_FILME) TOTAL FROM FILME F, VISUALIZACION V WHERE V.ID_USUARIO = (SELECT ID_USUARIO FROM USUARIO WHERE ALIAS = '$usuario') AND V.ID_FILME = F.ID_FILME GROUP BY F.TIPO_FILME WITH ROLLUP; ";
$resultado = $conexion -> query($sql);
while( $fila = $resultado -> fetch_assoc() ){ 
    if($i == 0){
        $peli = $fila['TOTAL']; 
    }else if($i == 1){
        $seri = $fila['TOTAL']; 
    }else if($i == 2){
        $total = $fila['TOTAL']; 
    }
    $i ++;
}
$sql = "SELECT HORAS_VISTAS('$usuario') HORAS";
$resultado = $conexion -> query($sql);
while( $fila = $resultado -> fetch_assoc() ){ 
    $HORAS = $fila['HORAS'];
}
$sql = "SELECT anio_vistos('$usuario') anios";
$resultado = $conexion -> query($sql);
while( $fila = $resultado -> fetch_assoc() ){ 
    $anio = $fila['anios'];
}

$sql = "SELECT DATE_FORMAT(SYSDATE(), '%Y') ANIO;";
$resultado = $conexion -> query($sql);
while( $fila = $resultado -> fetch_assoc() ){ 
    $anioREAL = $fila['ANIO'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>

        
    <title>GoodWatch | Mis filmes</title>
        
    <link rel="stylesheet" href="../css/misvisual.css">


    <!-- Letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Itim&display=swap" rel="stylesheet">

<body class="containertarjetas">
    <form action="Info_Vis.php" method="POST" id="formulario">
        <section class="datos" id="datos">
            <div class="datossub">
                <div class="informacion">
                    <div class="tag">
                        <p>Minutos de películas:</p>
                    </div>
                    <div class="inf">
                        <p><?php echo ($HORAS != NULL) ? $HORAS : "0" ?> min</p>
                    </div>
                </div>
                <div class="informacion">
                    <div class="tag">
                        <p>Películas vistas:</p>
                    </div>
                    <div class="inf">
                        <p><?php echo $peli;?></p>
                    </div>
                </div>
                <div class="informacion">
                    <div class="tag">
                        <p>Series vistas:</p>
                    </div>
                    <div class="inf">
                        <p><?php echo $seri;?></p>
                    </div>
                </div>
                <div class="informacion">
                    <div class="tag">
                        <p>Filmes vistos:</p>
                    </div>
                    <div class="inf">
                        <p><?php echo $total;?></p>
                    </div>
                </div>
                <div class="informacion">
                    <div class="tag">
                        <p>Filmes <?php echo $anioREAL;?>:</p>
                    </div>
                    <div class="inf">
                        <p><?php echo $anio;?></p>
                    </div>
                </div>
            </div>
            <?php 
                $sql = "SELECT * FROM FILMEVISTA WHERE ID_USUARIO = (SELECT ID_USUARIO FROM USUARIO WHERE ALIAS = '$usuario') ORDER BY FECHA ASC;";
                $resultado = $conexion -> query($sql);
                while( $fila = $resultado -> fetch_assoc() ){ 
                    $filme = $fila['ID_FILME']; 
                    $serie = $fila['TEMPORADA']; 
                    $visu = $fila['ID_VISUALIZACION']; 
                    ?>
                    <button class="tarjeta" name="submit" type="submit" value="<?php echo $visu;?>">
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
                        <div class="estrellasF"> <?php 
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
                        
                    </button>
                <?php }
            ?>
        </section>
    </form>

</body>
<?php 
    include "footer.php";
?>

</html>

