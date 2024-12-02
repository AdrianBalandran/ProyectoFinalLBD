<?php
session_start();

date_default_timezone_set('America/Mexico_City');

function datos($conexion, $id){
    $sql = "SELECT FI.NOMBRE, DESCRIPCION, IMAGEN, FECHA_ESTRENO, CLASIFICACION, ID.NOMBRE IDIOMA, PA.NOMBRE PAIS FROM FILME FI, IDIOMA ID, PAIS PA WHERE ID_FILME = '$id' AND FI.ID_IDIOMA = ID.ID_IDIOMA AND FI.ID_PAIS = PA.ID_PAIS;";
    $resultado = $conexion -> query($sql);
    while( $fila = $resultado -> fetch_assoc() ){
        $nombre = $fila['NOMBRE'];
        $num1 = 0;
        ?>
        <div class="info_filme">
            <div class="primer">
                <div class="imagen">
                    <img src="../imagenes/<?php echo $fila['IMAGEN'] ?>" alt="FILME">
                    <?php $_SESSION['imagen'] = $fila['IMAGEN'];?>
                </div>
                <div class="estrellas"> <?php
                        $sql1 = "SELECT ROUND(AVG(CALIFICACION), 1) CALI FROM VISUALIZACION WHERE ID_FILME = '$id';";
                        $resultado1 = $conexion -> query($sql1);
                        if ($resultado1->num_rows > 0) {
                        while( $fila1 = $resultado1 -> fetch_assoc() ){
                            if($fila1['CALI'] != NULL){
                            for ($i = 1; $i <= (int)$fila1['CALI']; $i++) { ?>
                                <img src="../imagenes/recursos/start.png" alt="Estrellas">
                            <?php }
                            $num1 = $fila1['CALI'];
                            $num = (float)$fila1['CALI'] - (int)$fila1['CALI']; 
                            $num = (float)$num;
                            $num = strval($num); 
                            if($num >= 0.1 && $num <= 0.2){ ?>
                                <img src="../imagenes/recursos/start2.png" alt="Estrellas" class="media2">
                            <?php }else if($num >= 0.3 && $num <= 0.4){
                                ?>
                                <img src="../imagenes/recursos/start4.png" alt="Estrellas" class="media4">
                                <?php
                            }else if($num == 0.5){
                                ?>
                                <img src="../imagenes/recursos/startmedia.png" alt="Estrellas" class="media">
                                <?php
                            }else if($num >= 0.6 && $num <= 0.7){
                                ?>
                                <img src="../imagenes/recursos/start6.png" alt="Estrellas" class="media6">
                                <?php
                            }else if($num >= 0.8 && $num <= 0.9){
                                ?>
                                <img src="../imagenes/recursos/start8.png" alt="Estrellas" class="media8">
                                <?php
                            }
                            } ?>
                            <?php
                        }
                    }else{
                        }?> 
                        </div>
                <div class="estno">
                    <?php
                    $sql1 = "SELECT COUNT(*) NOM FROM VISUALIZACION WHERE ID_FILME = '$id' GROUP BY ID_FILME;";
                    $resultado1 = $conexion -> query($sql1);
                    if ($resultado1->num_rows > 0) {
                        while( $fila1 = $resultado1 -> fetch_assoc() ){?>
                            <p class="nocali margen"><?php echo $num1 ?></p>
                        <?php
                            if($fila1['NOM'] == 1){?>                            
                            <p class="nocali"><?php echo $fila1['NOM'] ?> Calificación</p>
                        <?php } else{
                            ?>                            
                            <p class="nocali"><?php echo $fila1['NOM'] ?> Calificaciones</p>
                        <?php }
                            ?>
                        <?php 
                        }
                    }else{
                        ?>                            
                        <p class="nocali">0 Calificaciones</p>
                        <?php 
                    }
                        ?>
                </div>
                <?php 
                    if(isset($_SESSION['usuario'])){
                ?>
                <div class="formbtn boton visu">
                    <div class="backg">
                        <button class="agregar" type="button" id="desplegar"><p>Añadir</p></button>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="segundo">
                <div class="peliculaDatos">
                    <h2 class="titulo"><?php echo $fila['NOMBRE'] ?></h2>
                    <div class="desc divcont">
                        <div class="backg">
                            <p>Descripción:</p>
                        </div>
                        <div class="backginfo">
                            <p><?php echo $fila['DESCRIPCION'] ?></p>
                        </div>
                    </div>
                    <div class="estreno divcont">
                        <div class="backg">
                            <p>Estreno:</p>
                        </div>
                        <div class="backg colorwhite">
                            <p><?php echo $fila['FECHA_ESTRENO'] ?></p>
                        </div>
                    </div>
                    <div class="clasif divcont">
                        <div class="backg">
                            <p>Clasificación:</p>
                        </div>
                        <div class="backg colorwhite">
                            <p><?php echo $fila['CLASIFICACION'] ?></p>
                        </div>
                    </div>
                    <div class="idioma divcont">
                        <div class="backg">
                            <p>Idioma:</p>
                        </div>
                        <div class="backg colorwhite">
                            <p><?php echo $fila['IDIOMA'] ?></p>
                        </div>
                    </div>
                    <div class="pais divcont">
                        <div class="backg">
                            <p>País:</p>
                        </div>
                        <div class="backg colorwhite">
                            <p><?php echo $fila['PAIS'] ?></p>
                        </div>
                    </div>              
                </div>
                <div class="actordirector"> <?php
                        $sql1 = "SELECT RE.NOM_ART FROM REPARTO RE, FILME_REPARTO FIRE, FILME FI WHERE FI.ID_FILME = '$id' AND FI.ID_FILME = FIRE.ID_FILME AND RE.ID_REPARTO = FIRE.ID_REPARTO AND FIRE.TIPO_REPARTO = 'A';";
                        $resultado1 = $conexion -> query($sql1);  ?>
                    <div class="actores divcont">
                        <div class="divtit">
                            <div class="backg">
                                <p>Actores:</p>
                            </div>
                        </div>
                    <div class="lista">
                        <?php 
                        $sql1 = "SELECT RE.NOM_ART FROM REPARTO RE, FILME_REPARTO FIRE, FILME FI WHERE FI.ID_FILME = '$id' AND FI.ID_FILME = FIRE.ID_FILME AND RE.ID_REPARTO = FIRE.ID_REPARTO AND FIRE.TIPO_REPARTO = 'A';";
                        $resultado1 = $conexion -> query($sql1);
                        while( $fila1 = $resultado1 -> fetch_assoc() ){?>
                            <div class="backg colorwhite">
                                <p class="textstart"><?php echo $fila1['NOM_ART'] ?></p>
                            </div>
                        <?php 
                        } ?>
                        </div>
                    </div>
                    <?php 
                        $sql1 = "SELECT RE.NOM_ART FROM REPARTO RE, FILME_REPARTO FIRE, FILME FI WHERE FI.ID_FILME = '$id' AND FI.ID_FILME = FIRE.ID_FILME AND RE.ID_REPARTO = FIRE.ID_REPARTO AND FIRE.TIPO_REPARTO = 'D';";
                        $resultado1 = $conexion -> query($sql1);?>
                    <div class="actores divcont">
                        <div class="divtit">
                            <div class="backg">
                                <p>Directores:</p>
                            </div>
                        </div>
                        <div class="lista colorwhite">
                        <?php 
                        $sql1 = "SELECT RE.NOM_ART FROM REPARTO RE, FILME_REPARTO FIRE, FILME FI WHERE FI.ID_FILME = '$id' AND FI.ID_FILME = FIRE.ID_FILME AND RE.ID_REPARTO = FIRE.ID_REPARTO AND FIRE.TIPO_REPARTO = 'D';";
                        $resultado1 = $conexion -> query($sql1);                        
                        while( $fila1 = $resultado1 -> fetch_assoc() ){?>
                            <div class="backg">
                                <p class="textstart"><?php echo $fila1['NOM_ART'] ?></p>
                            </div>
                        <?php 
                        } ?>
                        </div>
                    </div>
                    <div class="generos divcont">
                        <div class="divtit">
                            <div class="backg">
                                <p>Géneros:</p>
                            </div>
                        </div>
                        <div class="lista colorwhite">
                        <?php 
                        // $sql1 = "SELECT *FROM REPARTO";
                        $sql1 = "SELECT GE.NOMBRE FROM GENERO GE, GENERO_FILME GEFI, FILME FI WHERE GE.ID_GENERO = GEFI.ID_GENERO AND FI.ID_FILME = GEFI.ID_FILME AND FI.ID_FILME = '$id';";
                        $resultado1 = $conexion -> query($sql1);
                        while( $fila1 = $resultado1 -> fetch_assoc() ){?>
                            <div class="backg">
                                <p class="textstart"><?php echo $fila1['NOMBRE'] ?></p>
                            </div>
                        <?php
                        }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
}else{
    if(isset($_POST['submit']) && isset($_SESSION['usuario'])){
        $id = $_POST["submit"];
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