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
            <h2 style="margin: 0 auto;padding-bottom: 30px;">Alta de temporadas</h2>
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

                    //Ingresar a la base (serie)
                    if (isset($_POST['idT'])) {
                        $idT = $_POST['idT'];
                        $tempT = $_POST['temporadaT'];
                        $numEpiT = $_POST['numeroEpiT'];
                        $fechaT = $_POST['fechaT'];

                        if(isset($_FILES["fileT"]) && !(empty($_FILES["fileT"]["tmp_name"]))){
                            $targetDir = "../imagenes/";  // Directorio donde se guardarán las imágenes
                            $targetFile = $targetDir . basename($_FILES["fileT"]["name"]);
                    
                            $check = getimagesize($_FILES["fileT"]["tmp_name"]);
                            if ($check !== false) {
                                if (!move_uploaded_file($_FILES["fileT"]["tmp_name"], $targetFile)) {
                                    echo "Hubo un problema al subir el archivo.";
                                }
                            } else { ?>
                                <div class="alert alert-warning" role="alert">
                                    <strong>El archivo </strong> no es una imagen válida.
                                </div>
                            <?php
                        }
                        $consS = "INSERT INTO SERIE VALUES ('$idT','$tempT','$numEpiT','$fechaT','$targetFile');";
                        $final2 = $conexion -> query($consS);
                    }
                    
                }
                    
            ?>

            <!-- Formulario temporadas -->
            <div id="form-temporada" class="formulario" style="padding-top:30px">
                <form action="" method="POST" enctype="multipart/form-data" id="formulario-temporada">
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="idT" class="form-label">Id de la serie</label>
                                    <input type="text" id="idT" name="idT" class="form-control" rquired>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="nombreT" class="form-label">Nombre</label>
                                    <input type="text" id="nombreT" name="nombreT" class="form-control" readonly>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $("#idT").on("change", function() {
                                        var idT = $(this).val();

                                        if (idT) {
                                            $.ajax({
                                                url: "buscarFilme.php",
                                                type: "POST",
                                                data: { idT: idT },
                                                success: function(response) {
                                                    // Parsear la respuesta
                                                    var data = JSON.parse(response);

                                                    // Imprimir el valor que quieres asignar
                                                    console.log("Nombre de la serie:", data.NOMBRE);

                                                    // Coloca el nombre obtenido en el campo nombreT
                                                    if (data.NOMBRE !== 'No encontrado') {
                                                        $("#nombreT").val(data.NOMBRE);
                                                    } else {
                                                        $("#nombreT").val('');
                                                        alert('Serie no encontrada');
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error("Error en la solicitud AJAX:", error);
                                                }
                                            });
                                        }
                                    });
                                });

                            </script>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="temporadaT" class="form-label">Temporada</label>
                                    <input type="text" id="temporadaT" name="temporadaT" class="form-control" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="numeroEpiT" class="form-label">Número de episodios</label>
                                    <input type="number" id="numeroEpiT" name="numeroEpiT" class="form-control" required>
                                </div>
                            </div>     
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="fechaT" class="form-label">Fecha de estreno</label>
                                    <input type="date" id="fechaT" name="fechaT" class="form-control" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label" for="file">Imagen:</label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="fileT" name="fileT" accept="image/*" onchange="mostrarImagen(event,3)" required>
                                    </div>
                                </div>
                            </div>        
                        </div>

                        <div class="col-3 d-flex align-items-center justify-content-end imagen">
                            <img id="imagenT" src="../imagenes/emptyImg.png" alt="Vista previa de la imagen" class="img-fluid" /> <!-- img-fluid ajusta la imagen -->
                        </div>
                    </div>

                    <div class="botonT">
                        <button class="btn btn-success" type="submit" name="submit-temporada" id="submit">Agregar</button>
                    </div>    
                </form>
            </div>
            <?php
            
                }
            ?>

        </div>
    </div>    
</body>