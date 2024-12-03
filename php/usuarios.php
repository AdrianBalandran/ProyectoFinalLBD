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
    <link rel="stylesheet" href="../css/usuarios.css">
    <script src="../js/imagen.js"></script>


    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="d-flex flex-nowrap">
        <?php include "../html/panelLateral.html"; ?>
        <script>
            document.getElementById("estadisticas-op").style.backgroundColor= "#5ae2a8";
        </script>
        <div class="d-flex flex-column contenido">

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
                    //Ingresar a la base (pelicula)
                    if(isset($_POST['submitModificado'])){
                    
                        if(isset($_FILES["file"]) && !(empty($_FILES["file"]["tmp_name"]))){
                            $targetDir = "../imagenes/recursos/";  // Directorio donde se guardarán las imágenes
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

                        $imgN = $_FILES["file"]["name"];
                        $sql1 = 'call Usuario_img("' . $imgN . '");'; //Consulta a reparto
                        $resultado1 = $conexion -> query($sql1);
                        

                    unset($_POST['submitModificado']);
                    } 
                }    
            
            ?>
            <div class="contenedor">
            <div class="titulo">
                <h2 style="margin: 0 auto; padding-bottom: 30px;">Usuarios</h2>
            </div>

            <div class="tabla">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Alias</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Imagen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql1 = $sql = 'SELECT * FROM USUARIO ORDER BY ID_USUARIO ASC;'; //Consulta a USUARIOS
                        $resultado1 = $conexion -> query($sql1);

                        if ($resultado1 -> num_rows){ //Si consulta exitosa
                            while ($fila = $resultado1->fetch_assoc()){ ?>
                                <tr>       
                                <th scope="row"> <?php echo $fila['ID_USUARIO'] ?></th>
                                <td><?php echo $fila['ALIAS'] ?></td>
                                <td><?php echo $fila['NOMBRE'] ?></td>
                                <td><?php echo $fila['EMAIL'] ?></td>
                                <td><?php echo $fila['TELEFONO'] ?></td>
                                <td> <img class="imagenP" src="../imagenes/recursos/<?php echo $fila['IMAGEN'] ?>" alt=""></td>
                                </tr>
                            <?php }
                        }

                        ?>  
                       
                    </tbody>
                </table>
            </div>



            <div class="titulo margin">
                <h2 >Cambiar imagen de usuarios</h2>
            </div>
            <div id="form-reparto" class="form-reparto formulario">
            <form action="" method="POST" enctype="multipart/form-data" id="formulario-reparto">    

            <div class="cont1">
                <div class="">
                    <label for="file">Imagen:</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="file" name="file" accept="image/*" onchange="mostrarImagen(event,1)" required>
                    </div>
                </div>
                <div class="botonRF ">
                    <button class="btn btn-success btnmod" type="submit" name="submitModificado" id="submit">Modificar</button>
                </div>
               
            </div>
            <div class="cont2">
                <div class=" imagen">
                    <img id="imagenP" src="../imagenes/emptyImg.png" alt="Vista previa de la imagen" />
                </div>
                
            </div>
            
        </div>
        </form>

        </div>
        </div>

     </div>
 

           
</body>

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
    
?>

