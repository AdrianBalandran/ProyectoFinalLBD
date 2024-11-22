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
            <h2 style="margin: 0 auto; padding-bottom: 30px;">Alta de reparto</h2>
            <?php
                
                $servername = "localhost:33065";
                $cuenta='root';
                $password='';
                $bd='goodWatch';
                
                //conexión a la base de datos
                $conexion = new mysqli($servername, $cuenta, $password, $bd);
                
                if($conexion -> connect_errno) {
                    die('Error en la conexión');
                } else {
                    //Obtenemos siguiente id de filmes
                    $sql = "SELECT MAX(ID_REPARTO) AS lastID FROM REPARTO";
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
                    if(isset($_POST['apellidoPR'])){
                        $idR = $_POST['idR'];
                        $nombreR = $_POST['nombreR'];
                        $apellidoPR = $_POST['apellidoPR'];
                        $apellidoMR = $_POST['apellidoMR'];
                        $nombreAR = $_POST['nombreAR'];
                        $fechaR = $_POST['fechaR'];
                        $paisR = $_POST['paisR'];

                        $consF = "INSERT INTO REPARTO VALUES ('$idR', '$nombreR', '$apellidoPR','$apellidoMR','$nombreAR','$fechaR','$paisR');";
                        $final = $conexion -> query($consF);
                        
                        unset($_POST['idR']);
                    }
                    if(isset($_POST['tipoR'])){
                        $idR = $_POST['idR'];
                        $idF = $_POST['idF'];
                        $tipoR = $_POST['tipoR'];
                        
                        $consF2 = "INSERT INTO FILME_REPARTO VALUES ('$idF', '$idR', '$tipoR');";
                        $final2 = $conexion -> query($consF2);
                    }
                    
            ?>

            <!-- Formulario de reparto-->
            <div id="form-reparto" class="form-reparto formulario">
                <form action="" method="POST" enctype="multipart/form-data" id="formulario-reparto">
                    <div class="row">
                        <div class="col-3 mb-3">
                            <label for="idR" class="form-label">ID</label>
                            <input type="text" id="idR" name="idR" class="form-control" value="<?php echo $nextID;?>" readonly>
                        </div>
                        <div class="col-9 mb-3">
                            <label for="nombreR" class="form-label">Nombre</label>
                            <input type="text" id="nombreR" name="nombreR" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="apellidoPR" class="form-label">Apellido paterno</label>
                            <input type="text" id="apellidoPR" name="apellidoPR" class="form-control" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="apellidoMR" class="form-label">Apellido materno</label>
                            <input type="text" id="apellidoMR" name="apellidoMR" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="nombreAR" class="form-label">Nombre Artístico</label>
                            <input type="text" id="nombreAR" name="nombreAR" class="form-control" required>
                        </div>    
                        <div class="col-4 mb-3">
                            <label for="fechaR" class="form-label">Fecha de nacimiento</label>
                            <input type="date" id="fechaR" name="fechaR" class="form-control" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="paisR" class="form-label">País</label>
                            <select class="form-select" name="paisR" required>
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
                    </div>
                    <div class="botonR">
                        <button class="btn btn-success" type="submit" name="submit-reparto" id="submit">Agregar</button>
                    </div>
                    
                </form>
            </div>

            <h2 style="margin: 0 auto; padding-bottom: 30px;">Vincular reparto-filme</h2>
            <!-- Formulario de reparto filme-->
            <div id="form-repartoFilme" class="form-repartoFilme formulario">
                <form action="" method="POST" enctype="multipart/form-data" id="formulario-repartoFilme">
                    <div class="row">
                        <div class="col-3 mb-3">
                            <label for="idR" class="form-label">Id Reparto</label>
                            <input type="text" id="idR" name="idR" class="form-control" required>
                        </div>
                        <div class="col-3 mb-3">
                            <label for="idF" class="form-label">Id FIlme</label>
                            <input type="text" id="idF" name="idF" class="form-control" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="tipoR" class="form-label">Tipo de reparto</label>
                            <select class="form-select" name="tipoR" required>
                                <option selected>Seleccionar...</option>
                                <option value="A">Actor/Actriz</option>
                                <option value="D">Director</option>
                            </select>
                        </div>
                    </div>
                    <div class="botonRF">
                        <button class="btn btn-success" type="submit" name="submit-repartoFilme" id="submit">Agregar</button>
                    </div>
                </form>
            </div>
            <?php
                }
            ?>

        </div>
    </div>    
</body>