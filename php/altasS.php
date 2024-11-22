<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/altas.css">
    <script src="https://kit.fontawesome.com/da89e5beb6.js" crossorigin="anonymous"></script>
    <title>Altas | GoodWatch</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/altas.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>
</head>
<body>
    <div class="d-flex flex-nowrap">
        <?php include "../html/panelLateral.html"; ?>
        <script>
            document.getElementById("altas-op").style.backgroundColor= "#5ae2a8";
        </script>
        <div class="d-flex flex-column contenido">
            <h2 style="margin: 0 auto; padding-bottom: 30px;">Alta de series</h2>
            <?php
                
                $servername = "localhost:3306";
                $cuenta='root';
                $password='';
                $bd='goodWatch';
                
                //conexión a la base de datos
                $conexion = new mysqli($servername, $cuenta, $password, $bd);
                
                if($conexion -> connect_errno){
                    die('Error en la conexión');
                } else {
                    //Obtenemos siguiente id de filmes
                    $sql = "SELECT MAX(ID_FILME) AS lastID FROM FILME";
                    $resultado = $conexion->query($sql);

                    if ($resultado-> num_rows > 0) {
                        //Obtener arreglo asociativo
                        $row = $resultado->fetch_assoc();
                        $lastID = $row['lastID'];
                        $nextID = $lastID + 1;
                    } else{
                        $nextID = '1';
                    }

                    //Ingresar a la base (filme)
                    if(isset($_POST['idS'])){
                        $idS = $_POST['idS'];
                        $nombreS = $_POST['nombreS'];
                        $descripS = $_POST['descripS'];
                        $fechaS = $_POST['fechaS'];
                        $clasifS = $_POST['clasifS'];
                        $idiomaS = $_POST['idiomaS'];
                        $paisS = $_POST['paisS'];
                        $tipoS = 'S';
                        $generoS = $_POST['generoS'];

                        if(isset($_FILES["fileS"]) && !(empty($_FILES["fileS"]["tmp_name"]))){
                            $targetDir = "../imagenes/";  // Directorio donde se guardarán las imágenes
                            $targetFile = $targetDir . basename($_FILES["fileS"]["name"]);
                    
                            $check = getimagesize($_FILES["fileS"]["tmp_name"]);
                            if ($check !== false) {
                                if (!move_uploaded_file($_FILES["fileS"]["tmp_name"], $targetFile)) {
                                    echo "Hubo un problema al subir el archivo.";
                                }
                            } else { ?>
                                <div class="alert alert-warning" role="alert">
                                    <strong>El archivo </strong> no es una imagen válida.
                                </div>
                            <?php
                        }

                        $consF = "INSERT INTO FILME VALUES ('$idS', '$nombreS', '$descripS','$targetFile','$fechaS','$clasifS','$idiomaS','$paisS','$tipoS');";
                        $consGF = "INSERT INTO GENERO_FILME VALUES ('$generoS','$idS');";
                        $final = $conexion -> query($consF);
                        $final3 = $conexion -> query($consGF);
                        unset($_POST['idS']);

                    }
                    
                }
                    
            ?>

            <!-- Formulario de series-->
            <div id="form-serie" class="form-serie formulario">
                <form action="" method="POST" enctype="multipart/form-data" id="formulario-serie">
                    <div class="row">
                        <div class="col-3 mb-3">
                            <label for="idS" class="form-label">ID</label>
                            <input type="text" id="idS" name="idS" class="form-control" value="<?php echo $nextID;?>" readonly>
                        </div>
                        
                        <div class="col-9 mb-3">
                            <label for="nombreS" class="form-label">Nombre</label>
                            <input type="text" id="nombreS" name="nombreS" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="fechaS" class="form-label">Fecha de estreno</label>
                            <input type="date" id="fechaS" name="fechaS" class="form-control" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="clasifS" class="form-label">Clasificación</label>
                            <select class="form-select" name="clasifS" required>
                                <option selected>Seleccionar...</option>
                                <option value="AA">AA</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="B15">B-15</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="idiomaS" class="form-label">Idioma</label>
                            <select class="form-select" name="idiomaS" required>
                                <option selected>Seleccionar..</option>
                                <?php

                                $sql1 = 'select * from idioma'; //Consulta a idiomas
                                $resultado1 = $conexion -> query($sql1);

                                if ($resultado1 -> num_rows){ //Si consulta exitosa
                                    while ($fila = $resultado1->fetch_assoc()) {
                                        //Agregamos cada opción con el valor del ID del idioma y el nombre
                                        echo '<option value="' . $fila['ID_IDIOMA'] . '">'. $fila['NOMBRE'] . '</option>';
                                    }
                                } else {
                                    echo '<option>No hay idiomas disponibles</option>'; // En caso de no haber resultados
                                }

                                ?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="paisS" class="form-label">País</label>
                            <select class="form-select" name="paisS" required>
                                <option selected>Seleccionar</option>
                                <?php

                                $sql2 = 'select * from pais'; //Consulta a país
                                $resultado2 = $conexion -> query($sql2);

                                if ($resultado2 -> num_rows){ //Si consulta exitosa
                                    while ($fila = $resultado2->fetch_assoc()) {
                                        //Agregamos cada opción con el valor del ID del idioma y el nombre
                                        echo '<option value="' . $fila['ID_PAIS'] . '">'. $fila['NOMBRE'] . '</option>';
                                    }
                                } else {
                                    echo '<option>No hay países disponibles</option>'; // En caso de no haber resultados
                                }

                                ?>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="generoS" class="form-label">Genero</label>
                            <select class="form-select" name="generoS" required>
                                <option selected>Seleccionar</option>
                                <?php

                                $sql3 = 'select * from genero'; //Consulta a genero
                                $resultado3 = $conexion -> query($sql3);

                                if ($resultado3 -> num_rows){ //Si consulta exitosa
                                    while ($fila = $resultado3->fetch_assoc()) {
                                        //Agregamos cada opción con el valor del ID del idiom
                                        echo '<option value="' . $fila['ID_GENERO'] . '">'. $fila['NOMBRE'] . '</option>';
                                    }
                                } else {
                                    echo '<option>No hay generos disponibles</option>'; // En caso de no haber resultados
                                }

                                ?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="file">Imagen:</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="fileS" name="fileS" accept="image/*" onchange="mostrarImagen(event,2)" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="descripS" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripS" rows="4" name="descripS" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center imagen">
                            <img id="imagenS" src="../imagenes/emptyImg.png" alt="Vista previa de la imagen" style="max-width: 100%; height: auto;" />
                        </div>
                    </div>
                    <div class="botonS">
                        <button class="btn btn-success" type="submit" name="submit-serie" id="submit">Agregar</button>
                        <a class="btn btn-primary" href="../php/altasT.php" >Dar de alta una temporada</a>
                    </div>
                    
                </form>
            </div>
            <?php
            
                }
            ?>

        </div>
    </div>    
</body>