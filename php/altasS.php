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
            <h2 style="margin: 0 auto;">Alta de series</h2>
            <?php
                
                $servername = "localhost:33065";
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
                        $nextID = '300';
                    }

                    //Ingresar a la base (pelicula)
                    if(isset($_POST['idP'])){
                        $idP = $_POST['idP'];
                        $nombreP = $_POST['nombreP'];
                        $descriP = $_POST['descripP'];
                        $fechaP = $_POST['fechaP'];
                        $clasifP = $_POST['clasifP'];
                        $idiomaP = $_POST['idiomaP'];
                        $paisP = $_POST['paisP'];
                        $tipoP = 'P';
                        $duracionP = $_POST['duracionP'];
                        $generoP = $_POST['generoP'];
                        if(isset($_FILES["file"]) && !(empty($_FILES["file"]["tmp_name"]))){
                            $targetDir = "../imagenes/";  // Directorio donde se guardarán las imágenes
                            $targetFile = $targetDir . basename($_FILES["file"]["name"]);
                    
                            $check = getimagesize($_FILES["file"]["tmp_name"]);
                            if ($check !== false) {
                                if (!move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                                    echo "Hubo un problema al subir el archivo.";
                                }
                            } else { ?>
                                <div class="alert alert-warning" role="alert">
                                    <strong>El archivo </strong> no es una imagen válida.
                                </div>
                            <?php
                            }
                    }
                    $consF = "INSERT INTO FILME VALUES ('$idP', '$nombreP', '$descriP','$targetFile','$fechaP','$clasifP','$idiomaP','$paisP','$tipoP');";
                    $consP = "INSERT INTO PELICULA VALUES ('$idP','$duracionP');";
                    $consGF = "INSERT INTO GENERO_FILME VALUES ('$generoP','$idP');";
                    $final = $conexion -> query($consF);
                    $final2 = $conexion -> query($consP);
                    $final3 = $conexion -> query($consGF);

                    unset($_POST['idP']);
                }else{ //reparto o serie

                }
                    
            ?>

            <!-- Cambio de oprciones -->
            <div class="select">
                <div class="Filtro">
                    <div class="radio-inputs">
                        <label class="radio">
                            <input type="radio" name="radio" value="nserie" checked>
                            <span class="name">Nueva serie</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="radio" value="ntemporada">
                            <span class="name">Nueva temporada</span>
                        </label>
                    </div>
                </div>
            </div>
            <script>
                //Cambiar vistas
                $('input[name="radio"]').change(function(){
                    var valorCambiado = $(this).val();

                    //Ocultar todos
                    $('#form-serie, #form-temporada').hide();
                    
                    //Mostrar seleccionado
                    if (valorCambiado === 'ntemporada') {
                        $('#form-temporada').show();
                    } else if (valorCambiado === 'nserie') {
                        $('#form-serie').show();
                    }
                });
            </script>

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
                            <label for="fechaP" class="form-label">Fecha de estreno</label>
                            <input type="date" id="fechaP" name="fechaP" class="form-control" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="clasifP" class="form-label">Clasificación</label>
                            <select class="form-select calsifP" name="clasifP" required>
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
                            <label for="idiomaP" class="form-label">Idioma</label>
                            <select class="form-select idiomaP" name="idiomaP" required>
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
                    <div class="col-4 mb-3">
                            <label for="paisP" class="form-label">País</label>
                            <select class="form-select paisP" name="paisP" required>
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
                        <div class="col-4 mb-3">
                            <label for="duracionP" class="form-label">Duración</label>
                            <input type="number" id="duracionP" name="duracionP" class="form-control">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="generoP" class="form-label">Genero</label>
                            <select class="form-select paisP" name="generoP" required>
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
                                    <input type="file" class="form-control" id="file2" name="file2" accept="image/*" onchange="mostrarImagen(event,2)" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="descrip" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descrip" rows="4" name="descripP" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img id="imagen2" src="../imagenes/emptyImg.png" alt="Vista previa de la imagen" style="max-width: 100%; height: auto;" />
                        </div>
                    </div>
                    <div class="botonP">
                        <!-- <button class="btn btn-success" type="submit" name="submit-pelicula" id="submit">Agregar</button> -->
                        <button class="btn btn-success">Agregar</button>
                    </div>
                </form>
            </div>
            <!-- Formulario temporadas -->
            <div id="form-temporada" class="formulario" style="display: none;">
                <form action="" method="POST" enctype="multipart/form-data" id="formulario-temporada">
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="idP" class="form-label">ID</label>
                                    <input type="text" id="idP" name="idP" class="form-control" value="<?php echo $nextID;?>" readonly>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="nombreP" class="form-label">Nombre</label>
                                    <input type="text" id="nombreP" name="nombreP" class="form-control" required>
                                </div>
                            </div>     
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="temporadaS" class="form-label">Temporada</label>
                                    <input type="text" id="temporadaS" name="temporadaS" class="form-control" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="numeroEpisodios" class="form-label">Número de episodios</label>
                                    <input type="text" id="numeroEpisodios" name="numeroEpisodios" class="form-control" required>
                                </div>
                            </div>     
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="fechaS" class="form-label">Fecha de estreno</label>
                                    <input type="date" id="fechaS" name="fechaS" class="form-control" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label" for="file">Imagen:</label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="file3" name="file3" accept="image/*" onchange="mostrarImagen(event,3)" required>
                                    </div>
                                </div>
                            </div>        
                        </div>

                        <div class="col-3 d-flex align-items-center justify-content-end imagen">
                            <img id="imagen3" src="../imagenes/emptyImg.png" alt="Vista previa de la imagen" class="img-fluid" /> <!-- img-fluid ajusta la imagen -->
                        </div>
                    </div>

                    <div class="botonP">
                        <!-- <button class="btn btn-success" type="submit" name="submit-pelicula" id="submit">Agregar</button> -->
                         <button class="btn btn-success">Agregar</button>
                    </div>    
                </form>
            </div>
            <?php
            
                }
            ?>

        </div>
    </div>    
</body>