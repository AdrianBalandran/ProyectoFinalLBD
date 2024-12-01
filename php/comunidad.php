<?php 
    //session_start();
    date_default_timezone_set('America/Mexico_City');

    $servidor="localhost";
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
        $sql = "SELECT * FROM COMUNIDAD;";
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
                        <?php
                            // Obtener el alias del usuario desde la sesión
                            $usuario_alias = $_SESSION['usuario'];

                            // Consultar los likes del usuario
                            $sql_likes = "SELECT ID_VISUAL FROM Megusta WHERE ID_USUARIO = (SELECT ID_USUARIO FROM Usuario WHERE alias = '$usuario_alias')";
                            $result_likes = $conexion->query($sql_likes);

                            // Crear un arreglo con los IDs de las visualizaciones con likes
                            $visualizaciones_liked = [];
                            if ($result_likes && $result_likes->num_rows > 0) {
                                while ($row = $result_likes->fetch_assoc()) {
                                    $visualizaciones_liked[] = $row['ID_VISUAL'];
                                }
                            }
                            $like = $fila['NUM_LIKES'] ?? 0;
                            $is_liked = in_array($fila['IDVIS'], $visualizaciones_liked);
                            $heart_src = $is_liked ? "../imagenes/recursos/heartLike.png" : "../imagenes/recursos/heart1.png";
                            $liked_class = $is_liked ? "liked" : "";
                        ?>
                        <img src="<?php echo $heart_src; ?>" alt="Like" class="like-button <?php echo $liked_class; ?>" data-visual="<?php echo $fila['IDVIS']; ?>">
                        <!-- Mostrar likes -->
                        <p id="likes-count-<?php echo $fila['IDVIS']; ?>"><?php echo $like; ?></p>
                        
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                        const likeButtons = document.querySelectorAll('.like-button');

                        likeButtons.forEach(button => {
                            button.addEventListener('click', () => {
                                const visualId = button.getAttribute('data-visual');

                                //evitar dar like si ya está marcado como liked
                                if (button.classList.contains('liked')) {
                                    return;
                                }

                                fetch('dar_like.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                    },
                                    body: `visual_id=${visualId}`
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        //Actualizar el contador de likes solo si se agrega un nuevo like
                                        const likeCount = document.getElementById(`likes-count-${visualId}`);
                                        likeCount.textContent = parseInt(likeCount.textContent) + 1;

                                        //Cambiar la imagen del corazón
                                        button.src = "../imagenes/recursos/heartLike.png";

                                        //Agregar la clase 'liked' al botón para que no se pueda likear
                                        button.classList.add('liked');
                                    } else {
                                        alert(data.message);
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                            });
                        });
                    });
                    </script>
                    <div class="comentarios">
                        <img src="../imagenes/recursos/comment.png" alt="">
                        <p>0</p>
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
