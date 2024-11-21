<?php 
    session_start();
    date_default_timezone_set('America/Mexico_City');
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


            <div class="update">

                <div class="head">
                    <img src="../imagenes/faviconi.png" alt="perfil" class="usuario">
                    <div>
                        <h5>Nombre Watched a film</h5>
                        <p>Fecha</p>
                    </div>
                    <p>Estrellitas</p>

                </div>

                <div class="comentario">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo quaerat molestias tempore cumque incidunt nemo corporis inventore, aut laudantium, quas debitis alias consectetur nihil officiis suscipit ipsum sed autem facilis!</p>
                </div>

                <div class="peliculaInfo">
                    <img src="../imagenes/emma.jpg" alt="">
                    <div class="description">
                        <div class="nomIcono">
                            <h2>Nombre</h2>
                            <img src="../imagenes/faviconi.png" alt="">
                        </div>
                       <div class="direcFecha">
                            <h5>Director</h5>
                            <p>anio</p>
                       </div>
                    
                        <p>Descripcion</p>
                    </div>
                </div>
                <div class="fav_com">
                    <div class="megustas">
                        <img src="../imagenes/recursos/heart.png" alt="">
                        <p>1</p>
                    </div>
                    <div class="comentarios">
                        <img src="../imagenes/recursos/comment.png" alt="">
                        <p>3</p>
                    </div>

                </div>
            </div>

        </section>
        <section class="mas">

        </section>
    </section>
</body>
<?php include "footer.php";?>

</html>


<?php 
    $servidor='localhost';
    $cuenta='root';
    $password='';
    $bd='GOODWATCH';

    //conexion a la base de datos
    $conexion = new mysqli($servidor, $cuenta, $password, $bd);

    function datos($conexion, $id, $temporada){
        $sql = "SELECT FI.NOMBRE, DESCRIPCION, SE.FECHA_ESTRENO, CLASIFICACION, ID.NOMBRE IDIOMA, PA.NOMBRE PAIS, SE.IMAGENTEM, SE.NUMERO_EPISODIOS NE FROM FILME FI, IDIOMA ID, PAIS PA, SERIE SE WHERE FI.ID_FILME = '$id' AND FI.ID_FILME = SE.ID_FILME AND SE.TEMPORADA = '$temporada' AND FI.ID_IDIOMA = ID.ID_IDIOMA AND FI.ID_PAIS = PA.ID_PAIS;";
        $resultado = $conexion -> query($sql);
        while( $fila = $resultado -> fetch_assoc() ){
    
        }
    }

?>

<!-- 
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
                        </div> -->
