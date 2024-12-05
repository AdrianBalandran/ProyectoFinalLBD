<?php
    $serv = "localhost:33065";
    $cuenta = 'root';
    $contra = '';
    $BaseD = 'GOODWATCH';

    //conexion con la base de datos 
    $conexion = new mysqli($serv,$cuenta,$contra,$BaseD);
    if($conexion->connect_error){
        die('Ocurrio un error en la conexion con la BD');
    }

    if (isset($_GET['visual_id'])) {
        $visual_id = intval($_GET['visual_id']);
    
        $stmt = $conexion->prepare("SELECT c.comentario AS text, u.alias AS author
                                    FROM Comentario c
                                    JOIN Usuario u ON c.ID_AUTOR = u.ID_USUARIO
                                    WHERE c.ID_VISUALIZACION = ?");
        $stmt->bind_param("i", $visual_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result) {
            $comments = [];
            while ($row = $result->fetch_assoc()) {
                $comments[] = $row;
            }
            echo json_encode(['status' => 'success', 'comments' => $comments]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al obtener los comentarios.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID de visualización no proporcionado.']);
    }

?>
