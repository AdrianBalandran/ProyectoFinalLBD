<?php 
include "menu.php";

function datos($conexion, $id){
    $sql = "SELECT FI.NOMBRE, DESCRIPCION, IMAGEN, FECHA_ESTRENO, CLASIFICACION, ID.NOMBRE IDIOMA, PA.NOMBRE PAIS FROM FILME FI, IDIOMA ID, PAIS PA WHERE ID_FILME = '$id' AND FI.ID_IDIOMA = ID.ID_IDIOMA AND FI.ID_PAIS = PA.ID_PAIS;";
    $resultado = $conexion -> query($sql);
    while( $fila = $resultado -> fetch_assoc() ){
        ?>
        <div class="info_filme">
            <div class="primer">
                <div class="imagen">
                    <img src="../recursos/<?php echo $fila['IMAGEN'] ?>" alt="FILME">
                </div>
            </div>
            <div class="segundo">
                <div class="peliculaDatos">
                    <h2><?php echo $fila['NOMBRE'] ?></h2>
                    <div class="desc">
                        <div class="backg">
                            <p>Descripción:</p>
                        </div>
                        <div class="backginfo">
                            <p><?php echo $fila['DESCRIPCION'] ?></p>
                        </div>
                    </div>
                    <div class="estreno">
                        <div class="backg">
                            <p>Estreno:</p>
                        </div>
                        <div class="backg">
                            <p><?php echo $fila['FECHA_ESTRENO'] ?></p>
                        </div>
                    </div>
                    <div class="clasif">
                        <div class="backg">
                            <p>Clasificación:</p>
                        </div>
                        <div class="backg">
                            <p><?php echo $fila['CLASIFICACION'] ?></p>
                        </div>
                    </div>
                    <div class="idioma">
                        <div class="backg">
                            <p>Idioma:</p>
                        </div>
                        <div class="backg">
                            <p><?php echo $fila['IDIOMA'] ?></p>
                        </div>
                    </div>
                    <div class="pais">
                        <div class="backg">
                            <p>País:</p>
                        </div>
                        <div class="backg">
                            <p><?php echo $fila['PAIS'] ?></p>
                        </div>
                    </div>              
                </div>
                <diV class="actordirector">
                    <div class="actores">
                        <div class="divtit">
                            <div class="backg">
                                <p>Actores:</p>
                            </div>
                        </div>
                        <div class="lista">
                        <?php 
                        // $sql1 = "SELECT *FROM REPARTO";
                        $sql1 = "SELECT RE.NOM_ART FROM REPARTO RE, FILME_REPARTO FIRE, FILME FI WHERE FI.ID_FILME = '$id' AND FI.ID_FILME = FIRE.ID_FILME AND RE.ID_REPARTO = FIRE.ID_REPARTO AND FIRE.TIPO_REPARTO = 'A';";
                        $resultado1 = $conexion -> query($sql1);
                        while( $fila1 = $resultado1 -> fetch_assoc() ){?>
                            <div class="backg">
                                <p><?php echo $fila1['NOM_ART'] ?></p>
                            </div>
                        <?php 
                        }?>
                        </div>
                    </div>
                    <?php 
                        $sql1 = "SELECT RE.NOM_ART FROM REPARTO RE, FILME_REPARTO FIRE, FILME FI WHERE FI.ID_FILME = '$id' AND FI.ID_FILME = FIRE.ID_FILME AND RE.ID_REPARTO = FIRE.ID_REPARTO AND FIRE.TIPO_REPARTO = 'D';";
                        $resultado1 = $conexion -> query($sql1);
                        $row = mysqli_fetch_array($resultado1,MYSQLI_ASSOC);
                        if(count($row)!=0) {?>
                    <div class="actores">
                        <div class="divtit">
                            <div class="backg">
                                <p>Directores:</p>
                            </div>
                        </div>
                        <div class="lista">
                        <?php 
                        $sql1 = "SELECT RE.NOM_ART FROM REPARTO RE, FILME_REPARTO FIRE, FILME FI WHERE FI.ID_FILME = '$id' AND FI.ID_FILME = FIRE.ID_FILME AND RE.ID_REPARTO = FIRE.ID_REPARTO AND FIRE.TIPO_REPARTO = 'D';";
                        $resultado1 = $conexion -> query($sql1);                        
                        while( $fila1 = $resultado1 -> fetch_assoc() ){?>
                            <div class="backg">
                                <p><?php echo $fila1['NOM_ART'] ?></p>
                            </div>
                        <?php 
                        }?>
                        </div>
                    </div>
                    <?php }?>
                        <div class="generos">
                        <div class="divtit">
                            <div class="backg">
                                <p>Géneros:</p>
                            </div>
                        </div>
                        <div class="lista">
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
                </diV>
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
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->

    <title>Info</title>
    <link rel="stylesheet" href="../css/info.css">

    <!-- Letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Itim&display=swap" rel="stylesheet">

<body>
    <section class="info" id="info">
        <?php datos($conexion, '00100') ?>
    </section>
</body>

</html>

