<?php 
    session_start();
    date_default_timezone_set('America/Mexico_City');

    $servidor='localhost';
    $cuenta='root';
    $password='';
    $bd='GOODWATCH';

    //conexion a la base de datos
    $conexion = new mysqli($servidor, $cuenta, $password, $bd);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>
    <title>GoodWatch | Comunidad</title>


    <link rel="stylesheet" href="../css/comunidad.css">

    <!-- Letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Itim&display=swap" rel="stylesheet">
    <header>
        <?php
            include ("encabezado.php");
        ?>
    </header>

<body class="">
    <section class="contenido">
        <section class="comunidad">

        <?php datos($conexion); ?>

        </section>
        <section class="mas">
            <div class="introduccion">
                <img src="../imagenes/<?php echo imagen(); ?>" alt="drama">
            </div>

            <h3>Recomendaciones</h3>

            <div class="recom">
                <?php recomS($conexion); ?>
                <?php recomP($conexion); ?>
            </div>

        </section>
    </section>
</body>
<?php include "footer.php";?>

</html>


<?php 

    function imagen(){
        $imagenes = array("loveAlarm1.jpg", "TOE.jpg", "OBS.jpg", "Startup.jpg");
        shuffle($imagenes);
        return $imagenes[0];
    }

    function recomS($conexion){
        $sql = "SELECT s.*, count(s.TEMPORADA) from serie s GROUP BY s.ID_FILME HAVING count(s.TEMPORADA) = 1;";
        $resultado = $conexion -> query($sql);
        $index = 0;
        while( $fila = $resultado -> fetch_assoc() ){
            $index ++;
            if($index <= 2){ 
                ?>
                <div class="recoPeli">
                    <img src="../imagenes/<?php echo $fila['IMAGENTEM']; ?>" alt="serie">
                </div>
                <p><a href="series.php">See more...</a></p>
            <?php 
            }
        }
    }

    function recomP($conexion){
        $sql = "SELECT * FROM FILME WHERE TIPO_FILME = 'P' ORDER BY FECHA_ESTRENO DESC;;";
        $resultado = $conexion -> query($sql);
        $index = 0;
        while( $fila = $resultado -> fetch_assoc() ){
            $index ++;
            if($index <= 2){ 
                ?>
                <div class="recoPeli">
                    <img src="../imagenes/<?php echo $fila['IMAGEN']; ?>" alt="pelicula">
                </div>
                <p><a href="peliculas.php">See more...</a></p>
            <?php 
            }
        }
    }

    function datos($conexion){
        $sql = "SELECT USU.NOMBRE NOMBRE, VI.ID_FILME FILME, VI.CALIFICACION CAL, VI.FECHA_VISUALIZACION VISU, VI.OPINION OPINION, PLA.NOMBRE NOMPLA, IDI.NOMBRE NOMIDI, FILME.NOMBRE NOMFILM, FILME.FECHA_ESTRENO ESTRENO, FILME.DESCRIPCION DES,
            VI.NUM_LIKES LIKES, IDIOMA.NOMBRE IDIOMA, VI.ID_FILME_SE ID, VI.TEMPORADA TEMP
            FROM VISUALIZACION VI, USUARIO USU, PLATAFORMA PLA, IDIOMA IDI, FILME, IDIOMA
            WHERE VI.ID_USUARIO = USU.ID_USUARIO
            AND PLA.ID_PLAT = VI.ID_PLATAFORMA
            AND IDI.ID_IDIOMA = VI.ID_IDIOMA
            AND FILME.ID_FILME = VI.ID_FILME
            AND IDIOMA.ID_IDIOMA = VI.ID_IDIOMA
            ORDER BY VI.FECHA_VISUALIZACION DESC;";

        $resultado = $conexion -> query($sql);

        while( $fila = $resultado -> fetch_assoc() ){ ?>

            <div class="update">

                <div class="head">
                    <div class="imgusuario">
                        <img src="../imagenes/recursos/usuario.png" alt="perfil" class="usuario">
                    </div>
                    <div class="nombreVisu">
                        <h5><span class="color"> <?php echo $fila['NOMBRE'] ?></span> Watched a film</h5>
                        <p><span class="color">Fecha: </span><?php echo $fila['VISU'];?> <span class="idioma"><span class="color">Idioma: </span><?php echo $fila['IDIOMA'];?></span> </p>
                    </div>
                    <div class="estrellas"> <?php
                            if($fila['CAL'] != NULL){
                            for ($i = 1; $i <= (int)$fila['CAL']; $i++) { ?>
                                <img src="../imagenes/recursos/start.png" alt="Estrellas">
                            <?php }
                             
                            for ($i = 1; $i <= 5-(int)$fila['CAL']; $i++) { ?>
                                <img src="../imagenes/recursos/starwhite.png" alt="Estrellas">
                            <?php }
                            }?>
                    
                        </div>
                </div>

                <div class="comentario">
                    <p><?php echo $fila['OPINION'] ?> </p>
                </div>

                <div class="peliculaInfo">
                    <?php if($fila['ID'] == NULL){
                        $ID = $fila['FILME'];
                         $sql = "SELECT FILME.IMAGEN IMG, P.DURACION DUR FROM FILME, PELICULA P 
                            WHERE P.ID_FILME = FILME.ID_FILME AND FILME.ID_FILME=$ID;";
                     $resultado1 = $conexion -> query($sql);
             
                     while( $fila1 = $resultado1 -> fetch_assoc() ){
                        $IMG = $fila1['IMG'];
                        $DUR = $fila1['DUR'] . " min";
                     }
                    }else {
                        $ID = $fila['FILME'];
                        $TEMP = $fila['TEMP'];
                        $IDSE = $fila['ID'];
                         $sql = "SELECT SERIE.NUMERO_EPISODIOS EP, SERIE.IMAGENTEM IMG, SERIE.FECHA_ESTRENO TEMPFECHA
                         FROM SERIE WHERE SERIE.ID_FILME = $ID AND SERIE.TEMPORADA = $TEMP;";
                        $resultado1 = $conexion -> query($sql);
             
                         while( $fila1 = $resultado1 -> fetch_assoc() ){
                            $IMG = $fila1['IMG'];
                            $DUR = $fila1['EP'] . " episodios";
                            $TEMPFECHA = $fila1['TEMPFECHA'];
                            
                     }
                    }?>
                    <div class="imgPeli">
                        <img src="../imagenes/<?php echo $IMG; ?>" alt="">
                    </div>
                    <div class="description">
                        <div class="nomIcono">
                            <h2> <?php echo $fila['NOMFILM']; if($fila['ID'] != NULL){echo "  " . $fila['TEMP']; }?> </h2>
                            <?php $ruta = "../imagenes/plataformas/" . plataforma($fila['NOMPLA']);?>                        
                            <img src="<?php echo $ruta?>" alt="">
                        </div>
                       <div class="direcFecha">
                            <h6><?php echo $DUR ?></h6>
                            <p><?php if($fila['ID'] == NULL){echo $fila['ESTRENO'];}else{ echo $TEMPFECHA; } ?></p>
                       </div>
                    
                        <p><?php echo $fila['DES'] ?></p>
                    </div>
                </div>
                <div class="fav_com">
                    <div class="megustas">
                        <?php $like = 0;
                        if($fila['LIKES'] != NULL) {
                            $like = $fila['LIKES'];
                        }?>
                        <img src="../imagenes/recursos/whiteheart.png" alt="">
                        <p><?php echo $like;?></p>
                    </div>
                    <div class="comentarios">
                        <img src="../imagenes/recursos/comment.png" alt="">
                        <p>3</p>
                    </div>

                </div>
            </div>
            
    <?php }
    }   
    
    
    function plataforma($plat){
        switch ($plat) {
            case "Netflix": 
                $ruta = "netflix.png";
                break;
            case "Prime Video": $ruta = "primeVideo.png";
                break;
            case "Max": $ruta = "max.png";
                break;
            case "Apple Tv": $ruta = "appleTv.png";
                break;
            case "Disney Plus": $ruta = "disney.png";
                break;    
            case "YouTube": $ruta = "youtube.png";
                break;
            case "VIX": $ruta = "vix.png";
                break;
            case "Paramount Plus": $ruta = "paramount.jpg";
                break;
            case "Star Plus": $ruta = "star.jpeg";
                break;
            case "¡QIYI!": $ruta = "qiyi.png";
                break;              
            case "Viki Rakuten": $ruta = "viki.png";
                break;
            case "WeTV": $ruta = "weTV.jpg";
                break;  
        }   
        return $ruta;     
    }
?>
