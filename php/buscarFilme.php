<?php
$servername = "localhost:3306";
$cuenta='root';
$password='';
$bd='goodWatch';

//conexión a la base de datos
$conexion = new mysqli($servername, $cuenta, $password, $bd);

if ($conexion->connect_errno) {
    die('Error en la conexión');
} else {
    if (isset($_POST['idT'])) {
        $idT = $_POST['idT'];

        // Consulta para obtener el nombre basado en el idT
        $sql4 = "SELECT NOMBRE FROM FILME WHERE ID_FILME = '$idT'";
        $result4 = $conexion->query($sql4);

        if ($result4->num_rows > 0) {
            $row = $result4->fetch_assoc();
            echo json_encode(['NOMBRE' => $row['NOMBRE']]);
        } else {
            // Si no se encuentra el id en la base de datos, devuelve un mensaje
            echo json_encode(['NOMBRE' => 'No encontrado']);
        }
    }
}
?>