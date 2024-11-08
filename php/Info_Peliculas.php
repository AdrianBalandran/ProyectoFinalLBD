<?php 
// include "encabezado.php";
session_start();
date_default_timezone_set('America/Mexico_City');

$nombre = "";
function datos($conexion, $id){
    $sql = "SELECT FI.NOMBRE, DESCRIPCION, IMAGEN, FECHA_ESTRENO, CLASIFICACION, ID.NOMBRE IDIOMA, PA.NOMBRE PAIS FROM FILME FI, IDIOMA ID, PAIS PA WHERE ID_FILME = '$id' AND FI.ID_IDIOMA = ID.ID_IDIOMA AND FI.ID_PAIS = PA.ID_PAIS;";
    $resultado = $conexion -> query($sql);
    while( $fila = $resultado -> fetch_assoc() ){
        ?>
        <div class="info_filme">
            <div class="primer">
                <div class="imagen">
                    <img src="../imagenes/<?php echo $fila['IMAGEN'] ?>" alt="FILME">
                </div>
                <div class="estrellas"> <?php
                        $sql1 = "SELECT ROUND(AVG(CALIFICACION), 1) CALI FROM VISUALIZACION WHERE ID_FILME = '$id';";
                        $resultado1 = $conexion -> query($sql1);
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
                        }?> 
                        </div>
                <div class="estno">
                    <p class="nocali margen"><?php echo $num1 ?></p>
                    <?php
                    

                    $sql1 = "SELECT COUNT(*) NOM FROM VISUALIZACION WHERE ID_FILME = '$id' GROUP BY ID_FILME;";
                    $resultado1 = $conexion -> query($sql1);
                        while( $fila1 = $resultado1 -> fetch_assoc() ){
                            if($fila1['NOM'] == 1){?>                            
                            <p class="nocali"><?php echo $fila1['NOM'] ?> Calificación</p>
                        <?php } else{
                            ?>                            
                            <p class="nocali"><?php echo $fila1['NOM'] ?> Calificaciones</p>
                        <?php }
                            ?>
                        <?php 
                        }
                    // }
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
                    <h2><?php echo $fila['NOMBRE'] ?></h2>
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
                                <p><?php echo $fila1['NOM_ART'] ?></p>
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
                                <p><?php echo $fila1['NOM_ART'] ?></p>
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
                                <p><?php echo $fila1['NOMBRE'] ?></p>
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
    if(isset($_POST['submit'])){
        $id = $_POST["submit"];
    }
    // $id = '10101';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->

    <title>GoodWatch | Información</title>
    <link rel="stylesheet" href="../css/info.css">

    <!-- Letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Itim&display=swap" rel="stylesheet">

<body>
    <section class="info" id="info">
        <?php datos($conexion, $id) ?>
    </section>
    <section class="agregarvis" id="agregarvis">
    <hr>
        <h2>Nueva Película</h2>
        <form action="Nueva_Vis_Pel.php" method="POST" id="formulario" class="formVisua">
            <div class="formbtn divcont">
                <div class="backg">
                    <label for="fecha" class="label"><p>Fecha:</p></label>
                </div>
                <div class="backg">
                    <input type="date" class="input" id="fecha" name="fecha" max="<?php echo date('Y-m-d')?>" required>
                </div>
            </div>
            <div class="formbtn divcont">
                <div class="backg">
                    <label for="idioma" class="label"><p>Idioma:</p></label>
                </div>
                <div class="backg">
                    <select name="idioma" id="idioma" name="idioma" required>
                    <?php 
                        $sql = "SELECT NOMBRE FROM IDIOMA;";
                        $resultado = $conexion -> query($sql);
                        while( $fila = $resultado -> fetch_assoc() ){?>
                            <option value="<?php echo $fila['NOMBRE'] ?>"><?php echo $fila['NOMBRE'] ?></option>
                        <?php 
                        }?>
                    </select>
                </div>
            </div>
            <div class="formbtn divcont">
                <div class="backg">
                    <label for="plataforma" class="label"><p>Plataforma:</p></label>
                </div>
                <div class="backg">
                <select name="plataforma" id="plataforma" required>
                    <?php 
                        $sql = "SELECT NOMBRE FROM PLATAFORMA;";
                        $resultado = $conexion -> query($sql);
                        while( $fila = $resultado -> fetch_assoc() ){?>
                            <option value="<?php echo $fila['NOMBRE'] ?>"><?php echo $fila['NOMBRE'] ?></option>
                        <?php 
                        }?>
                    </select>                
                </div>
            </div>
            <div class="formbtn textarea divcont">
                <div class="backg">
                    <label for="opinion" class="label"><p>Opinión:</p></label>
                </div>
                <div class="backg">
                    <textarea name="opinion" id="opinion" rows="7" cols="50"></textarea>
                </div>
            </div>
            <div class="conta">
                <div class="formbtn divcont">
                    <div class="backg">
                        <label for="calificacion" class="label"><p>Calificación:</p></label>
                    </div>
                    <div class="backg">
                        <input type="number" class="input" id="calificacion" min="0" max="5" step=".1" name="calificacion" value="0" required>
                    </div>
                </div>
                <div class="formbtn favorito">
                    <button type="button" class="favorito" id="fav"><img id="imgfav" src="../imagenes/recursos/whiteheart.png" alt="heart"></button>
                </div>
            </div>
            <div class="formbtn boton">
                <div class="backg">
                    <button class="agregar" type="submit" name="agregar"><p>Agregar</p></button>
                </div>
            </div>
            <input class="block" id="favorito" name="favorito" type="text" value="N">
            <input class="block" id="filme" name="filme" type="text" value="<?php echo $id; ?>">
        </form>
    </section>
</body>
<script src="../js/info.js"></script>

<?php include "footer.php";?>

</html>

