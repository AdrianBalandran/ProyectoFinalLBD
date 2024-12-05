<?php
    $serv = 'localhost:33065';
    $cuenta = 'root';
    $contra = '';
    $BaseD = 'GOODWATCH';

   //conexion con la base de datos 
    $conexion = new mysqli($serv,$cuenta,$contra,$BaseD);
   if($conexion->connect_error){
       die('Ocurrió un error en la conexión con la BD');
   }else{
        if(isset($_POST['agregar'])){
            session_start();

            $usuario = $_SESSION['usuario'];

            $fecha = $_POST["fecha"];
            $idioma = $_POST["idioma"];
            $plataforma = $_POST["plataforma"];
            $opinion = $_POST["opinion"];
            $calificacion = $_POST["calificacion"];
            $favorito = $_POST["favorito"];
            $filme = $_POST["filme"];
            $temporada = $_POST["temporada"];


            $sql = "SELECT ID_USUARIO FROM USUARIO WHERE ALIAS = '$usuario';";
            $resultado = $conexion -> query($sql);
            while( $fila = $resultado -> fetch_assoc() ){
              $usuario = $fila['ID_USUARIO'];
            }
            $sql = "SELECT ID_IDIOMA FROM IDIOMA WHERE NOMBRE = '$idioma';";
            $resultado = $conexion -> query($sql);
            while( $fila = $resultado -> fetch_assoc() ){
              $idioma = $fila['ID_IDIOMA'];
            }
            $sql = "SELECT ID_PLAT FROM PLATAFORMA WHERE NOMBRE = '$plataforma';";
            $resultado = $conexion -> query($sql);
            while( $fila = $resultado -> fetch_assoc() ){
              $plataforma = $fila['ID_PLAT'];
            }


            // nextval(Visualizacion_Id)
            $sql = "INSERT INTO VISUALIZACION VALUES(nextval(Visualizacion_Id),'$filme','$fecha','$calificacion','$opinion', '$idioma', '$plataforma', '$usuario', '$favorito', NULL, '$filme', '$temporada', 0);";
            $resultado = $conexion->query($sql);

            echo $sql;
            if ($conexion->affected_rows >= 1){ 
              echo "registro insertado" ;
              $_SESSION['InsertadaS'] = true;
            header(header: "Location: series.php");
            }
            header(header: "Location: series.php");
        }   
        header(header: "Location: series.php");
      }
 ?>