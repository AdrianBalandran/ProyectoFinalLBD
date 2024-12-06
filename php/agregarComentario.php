<?php
session_start();


    $serv = "localhost";
    $cuenta = 'root';
    $contra = '';
    $BaseD = 'GOODWATCH';

    // Conexion a la base de datos
    $conexion = new mysqli($serv, $cuenta, $contra, $BaseD);
    if ($conexion->connect_error) {
        die('Ocurrio un error en la conexion con la BD');
    }

    if (isset($_POST['visual_id']) && isset($_POST['comment_text'])) {
        $visual_id = intval($_POST['visual_id']);
        $comment_text = htmlspecialchars(trim($_POST['comment_text']));
        $usuario_alias = $_SESSION['usuario']; //alias del usuario activo

        //Obtener el ID_USUARIO usando el alias
        $sql_usuario = "SELECT ID_USUARIO FROM Usuario WHERE alias = '$usuario_alias'";
        $result_usuario = $conexion->query($sql_usuario);
    
        //Si existe el usuario
        if ($result_usuario && $result_usuario->num_rows > 0) {
            $usuario_row = $result_usuario->fetch_assoc();
            $usuario_id = $usuario_row['ID_USUARIO'];
            
            $query = "INSERT INTO Comentario (COMENTARIO, ID_AUTOR, ID_VISUALIZACION) VALUES ('$comment_text', $usuario_id, $visual_id)";

            if ($conexion->query($query)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar el comentario']);
            }
        }else {
            echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado']);
            exit;
        }

    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos']);
    }
?>