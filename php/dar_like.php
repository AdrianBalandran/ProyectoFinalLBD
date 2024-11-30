<?php
session_start();

$serv = "localhost:33065";
    $cuenta = 'root';
    $contra = '';
    $BaseD = 'GOODWATCH';

    //conexion con la base de datos 
    $conexion = new mysqli($serv,$cuenta,$contra,$BaseD);
    if($conexion->connect_error){
        die('Ocurrio un error en la conexion con la BD');
    } else{

    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['usuario'])) {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
        exit;
    }

    $usuario_alias = $_SESSION['usuario']; //alias del usuario activo
    $visual_id = $_POST['visual_id']; // ID de la visualización

    // Validar datos
    if (empty($usuario_alias) || empty($visual_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
        exit;
    }

    try {
        //Obtener el ID_USUARIO usando el alias
        $sql_usuario = "SELECT ID_USUARIO FROM Usuario WHERE alias = '$usuario_alias'";
        $result_usuario = $conexion->query($sql_usuario);
    
        if ($result_usuario && $result_usuario->num_rows > 0) {
            $usuario_row = $result_usuario->fetch_assoc();
            $usuario_id = $usuario_row['ID_USUARIO'];
    
            //Verificar si ya dio like a esta visualización
            $sql_check = "SELECT COUNT(*) AS total FROM Megusta WHERE ID_VISUAL = '$visual_id' 
            AND ID_USUARIO = '$usuario_id'";
    
            $result_check = $conexion->query($sql_check);
            $row_check = $result_check->fetch_assoc();
    
            //Si ya existe el like, no hacer nada
            if ($row_check['total'] > 0) {
                exit;
            }
    
            //Si no existe insertar el nuevo like
            $sql_insert = "INSERT INTO Megusta (ID_VISUAL, ID_USUARIO) VALUES ('$visual_id', '$usuario_id')";
            
            if ($conexion->query($sql_insert) === TRUE) {
                echo json_encode(['status' => 'success', 'message' => 'Like agregado correctamente']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al agregar el like']);
            }
    
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado']);
            exit;
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error en el servidor: ' . $e->getMessage()]);
    }
}
?>