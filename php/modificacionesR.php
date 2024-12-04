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
            document.getElementById("modificar-op").style.backgroundColor= "#5ae2a8";
        </script>
        <div class="d-flex flex-column contenido">
            <h2 style="margin: 0 auto; padding-bottom: 30px;">Modificaciones de reparto</h2>
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

                    //Ingresar a la base (reparto)
                    if(isset($_POST['submitModificado'])){
                        $idR = $_POST['id'];
                        $nombreR = $_POST['nombre'];
                        $primape = $_POST['primape'];
                        $segape = $_POST['segape'];
                        $nomArt = $_POST['nomArt'];
                        $fechaR = $_POST['fechaNac'];
                        $paisR = $_POST['paisR'];

                        $consF = "UPDATE REPARTO SET NOMBRE='$nombreR', PRIMAPE='$primape', SEGAPE='$segape', NOM_ART='$nomArt', FECHA_NAC='$fechaR', ID_PAIS='$paisR' WHERE ID_REPARTO='$idR' ;";
                        $final = $conexion -> query($consF);

                        $_SESSION['insertadoR'] = true;
                        
                        unset($_POST['submitModificado']);                        
                    }

                } 
            
            ?>

            <!-- Formulario de reparto (escoger el id)-->
            <div id="form-reparto" class="form-reparto formulario">
                <form action="" method="POST" enctype="multipart/form-data" id="formulario-reparto">
                    <div class="idReparto">
                        <label for="reparto">Reparto</label>
                        <?php Select($conexion); ?>
                    </div>
                    <div>
                        <div class="botonRF">
                            <button class="btn btn-success btnSelect" type="submit" name="submitRepartoFilme" id="submit">Seleccionar</button>
                        </div>
                    </div>
                </form>    
            </div>

            <?php 
            // Formulario del id para desplegar el id seleccionado
            if(isset($_POST['submitRepartoFilme'])){ 
                $ID = $_POST['id_reparto']; 
                $_SESSION['ID'] = $ID;
                unset($_POST['submitRepartoFilme']);
            }  else{
                // La primera vez será este id
                $ID = '30009';
                $_SESSION['ID'] = $ID;
            }
            $sql1 = $sql = 'SELECT * FROM REPARTO WHERE ID_REPARTO='. $ID.';'; //Consulta a reparto
                $resultado1 = $conexion -> query($sql1);
                // Declarar valores para ingresarlos en los inputs
                if ($resultado1 -> num_rows){ //Si consulta exitosa
                    while ($fila = $resultado1->fetch_assoc()){
                        $filaId = $fila['ID_REPARTO'];
                        $filaNom = $fila['NOMBRE'];
                        $filaPrim = $fila['PRIMAPE'];
                        $filaSeg = $fila['SEGAPE'];
                        $filaArt = $fila['NOM_ART'];
                        $filaNac = $fila['FECHA_NAC'];
                        $filaPais = $fila['ID_PAIS'];
                    }
                }    
            ?>

                     <!-- Formulario de los datos de reparto-->
                    <div id="form-reparto-Datos" class="form-reparto formulario">
                        <form action="" method="POST" enctype="multipart/form-data" id="formulario-reparto">

                            <div class="datos">
                            <!-- Id del reparto -->
                            <div class="col-3 mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" id="id" name="id" class="form" value="<?php echo $filaId ?>" required  readonly="readonly" >
                            </div>
                            <!-- Nombre -->
                            <div class="col-3 mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form" value="<?php echo $filaNom ?>" minlength="1" maxlength="30" required>
                            </div>
                            <!-- Primer Apellido -->
                            <div class="col-3 mb-3">
                                <label for="primape" class="form-label">Primer Apellido</label>
                                <input type="text" id="primape" name="primape" class="form" value="<?php echo $filaPrim ?>" minlength="1" maxlength="20" required>
                            </div>  
                            <!-- Segundo Apellido -->             
                            <div class="col-3 mb-3">
                                <label for="segape" class="form-label">Segundo Apellido</label>
                                <input type="text" id="segape" name="segape" class="form" value="<?php echo $filaSeg ?>"  maxlength="20">
                            </div>      
                            <!-- Nombre artístico -->
                            <div class="col-3 mb-3">
                                <label for="nomArt" class="form-label">Nombre Artístico</label>
                                <input type="text" id="nomArt" name="nomArt" class="form" value="<?php echo $filaArt ?>"  minlength="1" maxlength="30" required>
                            </div>  
                            <!-- Fecha de nacimiento -->
                            <div class="col-3 mb-3">
                                <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" id="fechaNac" name="fechaNac" class="form" value="<?php echo $filaNac ?>" max="<?php echo date('Y-m-d'); ?>" required>
        
                            </div> 
                            <!-- País -->  
                            <div class="col-4 mb-3">
                                    <label for="paisR" class="form-label">País</label>
                                    <select class="form" name="paisR" required>
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

                            </div>
                            <!-- Botón submit -->
                            <div class="botonRF">
                                <button class="btn btn-success btnmod" type="submit" name="submitModificado" id="submit">Modificar</button>
                            </div>
                    
                        </form>    
                    </div>

           
</body>

<?php 
// Seleccionar los id de todos los repartos
 function Select($conexion){
    $sql = 'Select * FROM Reparto;';//hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
    $resultado = $conexion -> query($sql);?>
    <select class="form" name="id_reparto" id="selected" required>
    <?php
        $sql1 = $sql = "SELECT * FROM REPARTO"; //Consulta a reparto
        $resultado1 = $conexion -> query($sql1);

        if ($resultado1 -> num_rows){ //Si consulta exitosa
            while ($fila = $resultado1->fetch_assoc()) {
                //Agregamos cada opción con el valor del ID del idioma y el nombre
                
                if(isset($_POST['submitRepartoFilme']) && $_POST['id_reparto'] == $fila['ID_REPARTO']){
                    echo '<option selected value="' . $fila['ID_REPARTO'] . '">'. $fila['ID_REPARTO'] . '</option>';
                }else{
                    echo '<option value="' . $fila['ID_REPARTO'] . '">'. $fila['ID_REPARTO'] . '</option>';
                }
            }
        } else {
            echo '<option>No hay reparto</option>'; // En caso de no haber resultados
        }
        ?>
    </select> 

    <?php 

// Si se ingreso se despliega un sweetalert
if(isset($_SESSION['insertadoR'])){ 
    unset($_SESSION['insertadoR'])?>
        <script>
            Swal.fire({
            title: "Modificado",
            text: "Reparto modificado correctamente",
            icon: "success"
          });
        </script>
        <?php
}
    
}


