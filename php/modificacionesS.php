<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/da89e5beb6.js" crossorigin="anonymous"></script>
    <title>Modificaciones | GoodWatch</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/modificar.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="d-flex flex-nowrap">
        <?php include "../html/panelLateral.html"; ?>
        <script>
            document.getElementById("altas-op").style.backgroundColor= "#5ae2a8";
        </script>
        <div class="d-flex flex-column contenido">
            <h2 style="margin: 0 auto; padding-bottom: 30px;">Modificaciones de Series</h2>
            <?php
                
                $servername = "localhost";
                $cuenta='root';
                $password='';
                $bd='goodWatch';
                
                //conexión a la base de datos
                $conexion = new mysqli($servername, $cuenta, $password, $bd);
                
                if($conexion -> connect_errno) {
                    die('Error en la conexión');
                } else {

                    //Ingresar a la base (filme)
                    if(isset($_POST['submitModificado'])){
                        $idF = $_SESSION['ID'];
                        $nombreF = $_POST['nombre'];
                        $fechaEF = $_POST['fechaEst'];
                        $clasF = $_POST['clasifF'];
                        $paisF = $_POST['paisF'];
                        $idiomaF = $_POST['idiomaF'];
                        $descF = $_POST['descripcion'];

                        $consF = "UPDATE FILME SET NOMBRE='$nombreF', DESCRIPCION='$descF', FECHA_ESTRENO='$fechaEF', CLASIFICACION='$clasF', ID_IDIOMA='$idiomaF', ID_PAIS='$paisF' WHERE ID_FILME='$idF';";
                        $final = $conexion -> query($consF);
                        
                        $consF = "UPDATE PELICULA SET DURACION='$duracionF' WHERE ID_FILME='$idF' ;";
                        $final = $conexion -> query($consF);

                        $_SESSION['insertadoF'] = true;
                        
                        unset($_POST['submitModificado']);
                    }

                    //Modificar temporada de la serie (filme)
                    if(isset($_POST['submitFilmeTemporada'])){
                        $idFT = $_SESSION['ID'];
                        $temp = $_POST['temp'];
                        $Episodios = $_POST['noE'];
                        $fechaET = $_POST['fechaET'];

                        $consF = "UPDATE SERIE SET NUMERO_EPISODIOS='$Episodios', FECHA_ESTRENO='$fechaET' WHERE ID_FILME='$idFT' AND TEMPORADA='$temp';";
                        $final = $conexion -> query($consF);

                        $_SESSION['insertadoF'] = true;
                        
                        unset($_POST['submitFilmeTemporada']);
                    }

                } 
            
            ?>

            <!-- Formulario de reparto-->
            <div id="form-reparto" class="form-reparto formulario">
                <form action="" method="POST" enctype="multipart/form-data" id="formulario-reparto">
                    <div class="idReparto">
                        <label for="filme">Filme</label>
                        <?php Select($conexion); ?>
                    </div>
                    <div>
                        <div class="botonRF">
                            <button class="btn btn-success btnSelect" type="submit" name="submitFilme" id="submit">Seleccionar</button>
                        </div>
                    </div>
                </form>    
            </div>

            <?php 
            
            if(isset($_POST['submitFilme'])){ 
                $ID = $_POST['id_filme']; 
                $_SESSION['ID'] = $ID;
                unset($_POST['submitFilme']);
            }  else{
                $ID = '00301';
                $_SESSION['ID'] = $ID;
            }
                $sql1 = $sql = 'SELECT * FROM Filme WHERE ID_FILME='. $ID.';'; //Consulta a reparto
                $resultado1 = $conexion -> query($sql1);

                if ($resultado1 -> num_rows){ //Si consulta exitosa
                    while ($fila = $resultado1->fetch_assoc()){
                        $filaId = $fila['ID_FILME'];
                        $filaNom = $fila['NOMBRE'];
                        $filaDes = $fila['DESCRIPCION'];
                        $filaEst = $fila['FECHA_ESTRENO'];
                        $filaclas = $fila['CLASIFICACION'];
                        $filaIdioma = $fila['ID_IDIOMA'];
                        $filaPais = $fila['ID_PAIS'];  
                    }
                }    
                // $sql1 = $sql = 'SELECT * FROM PELICULA WHERE ID_FILME='. $ID.';'; //Consulta a reparto
                // $resultado1 = $conexion -> query($sql1);

                // if ($resultado1 -> num_rows){ //Si consulta exitosa
                //     while ($fila = $resultado1->fetch_assoc()){
                //         $filaDur = $fila['DURACION'];
                //     }
                // }  
            ?>

                    <div id="form-reparto-Datos" class="form-reparto formulario">
                        <form action="" method="POST" enctype="multipart/form-data" id="formulario-reparto">

                            <div class="datos">
                            <!-- <div class="col-3 mb-3">
                                <label for="idFilme" class="form-label">ID</label>
                                <input type="text" id="idFilme" name="idFilme" class="form" value="<?php echo $filaId ?>" required  disabled >
                            </div> -->
                            <div class="col-3 mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" id="id" name="id" class="form" value="<?php echo $filaId ?>" required  disabled >
                            </div>
                            
                            <div class="col-3 mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form" value="<?php echo $filaNom ?>" required>
                            </div>

                            <div class="col-3 mb-3">
                                <label for="fechaEst" class="form-label">Fecha de Estreno</label>
                                <input type="date" id="fechaEst" name="fechaEst" class="form" value="<?php echo $filaEst ?>" required>
                            </div>   
                            <div class="col-4 mb-3">
                                <?php $clas = array("AA", "A", "B", "B15", "C", "D"); ?>
                                <label for="clasifF" class="form-label">Clasificación</label>
                                <select class="form-select calsifP" name="clasifF" required>
                                    <option selected disabled>Seleccionar...</option>
                                    <?php foreach ($clas as $value) {
                                        if($filaclas == $value){
                                            echo '<option selected value="' . $value . '">'. $value . '</option>';
                                        }else{
                                            echo '<option value="' . $value . '">'. $value . '</option>';
                                        }
                                    } ?>
                                </select>
                            </div>
    
                                <div class="col-4 mb-3">
                                    <label for="idiomaF" class="form-label">Idioma</label>
                                    <select class="form" name="idiomaF" required>
                                        <option selected disabled>Seleccionar</option>
                                        <?php

                                        $sql2 = 'select * from idioma'; //Consulta a país
                                        $resultado2 = $conexion -> query($sql2);

                                        if ($resultado2 -> num_rows){ //Si consulta exitosa
                                            while ($fila1 = $resultado2->fetch_assoc()) {
                                                //Agregamos cada opción con el valor del ID del idioma y el nombre
                                                if($filaIdioma == $fila1['ID_IDIOMA']){
                                                    echo '<option selected value="' . $fila1['ID_IDIOMA'] . '">'. $fila1['NOMBRE'] . '</option>';
                                                }else{
                                                    echo '<option value="' . $fila1['ID_IDIOMA'] . '">'. $fila1['NOMBRE'] . '</option>';
                                                }
                                            }
                                        } else {
                                            echo '<option>No hay países disponibles</option>'; // En caso de no haber resultados
                                        }
                                        ?>
                                    </select>
                                </div>      
                                <div class="col-4 mb-3">
                                    <label for="paisF" class="form-label">País</label>
                                    <select class="form" name="paisF" required>
                                        <option selected disabled>Seleccionar</option>
                                        <?php

                                        $sql2 = 'select * from pais'; //Consulta a país
                                        $resultado2 = $conexion -> query($sql2);

                                        if ($resultado2 -> num_rows){ //Si consulta exitosa
                                            while ($fila1 = $resultado2->fetch_assoc()) {
                                                //Agregamos cada opción con el valor del ID del idioma y el nombre
                                                if($filaPais == $fila1['ID_PAIS']){
                                                    echo '<option selected value="' . $fila1['ID_PAIS'] . '">'. $fila1['NOMBRE'] . '</option>';
                                                }else{
                                                    echo '<option value="' . $fila1['ID_PAIS'] . '">'. $fila1['NOMBRE'] . '</option>';
                                                }
                                            }
                                        } else {
                                            echo '<option>No hay países disponibles</option>'; // En caso de no haber resultados
                                        }
                                        ?>
                                    </select>
                                </div> 
                                   
                                <div class="col-3 mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <!-- <input type="text" id="descipcion" name="descipcion" class="form" value="<?php echo $filaDes ?>" required> -->
                                    <textarea id="descripcion" name="descripcion" rows="5" cols="33" class="form"><?php echo $filaDes ?>
                                    </textarea>
                                </div>    

                            </div>
                            <div class="botonRF">
                                <button class="btn btn-success btnmod" type="submit" name="submitModificado" id="submit">Modificar</button>
                            </div>
                    
                        </form>    
                    </div>

                    <h2 style="margin: 0 auto; padding-bottom: 30px; margin-top: 30px;">Temporadas</h2>



            <!-- Formulario de TEMPORADAS-->
             <?php 
            $sql1 = $sql = 'SELECT * FROM SERIE WHERE ID_FILME='. $ID.';'; //Consulta a reparto
            $resultado1 = $conexion -> query($sql1);

            if ($resultado1 -> num_rows){ //Si consulta exitosa
                while ($fila = $resultado1->fetch_assoc()){?>
                    <div id="form-reparto" class="form-reparto formulario ">
                    <form action="" method="POST" enctype="multipart/form-data" id="formulario-reparto">
                        <div class="datos">
                    
                        <input type="text" id="idFT" name="idFT" class="form hidden" value="<?php echo $fila['ID_FILME'] ?>" readonly="readonly"  disabled >
                        <div class="idReparto">
                            <label for="temp">Temporada</label>
                            <input type="text" id="temp" name="temp" class="form" value="<?php echo $fila['TEMPORADA'] ?>" readonly="readonly" required >
                        </div>
                        <div class="idReparto">
                            <label for="noE">Número de Episodios</label>
                            <input type="number" id="noE" name="noE" class="form" value="<?php echo $fila['NUMERO_EPISODIOS'] ?>" required  >
                        </div>
                        <div class="idReparto">
                            <label for="fechaET">Fecha de Estreno</label>
                            <input type="date" id="fechaET" name="fechaET" class="form" value="<?php echo $fila['FECHA_ESTRENO'] ?>" required  >
                        </div>
                        <div>
                            <div class="botonRF">
                                <button class="btn btn-success btnSelect" type="submit" name="submitFilmeTemporada" id="submit">Modificar</button>
                            </div>
                        </div>
                    </div>
                    </form>    
                    </div>   
                    <?php  
                }
            }  
            ?>
           
</body>

<?php 
 function Select($conexion){  ?>
    <select class="form" name="id_filme" id="selected" required>
    <?php
        $sql1 = "SELECT * FROM FILME WHERE TIPO_FILME='S'"; //Consulta a reparto
        $resultado1 = $conexion -> query($sql1);

        if ($resultado1 -> num_rows){ //Si consulta exitosa
            while ($fila = $resultado1->fetch_assoc()) {
                //Agregamos cada opción con el valor del ID del idioma y el nombre
                
                if(isset($_POST['submitFilme']) && $_POST['id_filme'] == $fila['ID_FILME']){
                    echo '<option selected value="' . $fila['ID_FILME'] . '">'. $fila['ID_FILME'] . '</option>';
                }else{
                    echo '<option value="' . $fila['ID_FILME'] . '">'. $fila['ID_FILME'] . '</option>';
                }
            }
        } else {
            echo '<option>No hay reparto</option>'; // En caso de no haber resultados
        }
        ?>
    </select> 

    <?php 

if(isset($_SESSION['insertadoF'])){ 
    unset($_SESSION['insertadoF'])?>
        <script>
            Swal.fire({
            title: "Modificado",
            text: "Filme modificado correctamente",
            icon: "success"
          });
        </script>
        <?php
}
    
}


