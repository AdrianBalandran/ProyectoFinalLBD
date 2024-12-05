<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bajas.css">
    <script src="https://kit.fontawesome.com/da89e5beb6.js" crossorigin="anonymous"></script>
    <title>Bajas | GoodWatch</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>
</head>
<body>
<div class="d-flex flex-nowrap">
    <?php include "../html/panelLateral.html"; ?>
    <script>
            document.getElementById("bajas-op").style.backgroundColor= "#5ae2a8";
        </script>
    <div class="d-flex flex-column contenido">
        <h2 style="margin: 0 auto; padding-bottom: 30px;">Bajas de Series</h2>

        <div class="text-end">
            <form method="GET" action="">
                <div class="d-flex justify-content-end align-items-center">
                    <input type="text" name="search_id" class="form-control" placeholder="Buscar por ID" style="width: 200px;">
                    <button type="submit" class="btn btn-primary ml-2" style="margin-right:10px">Buscar</button>
                    <!-- Botón para mostrar todos los registros, alineado al lado del campo de búsqueda -->
                    <a href="bajasS.php" class="btn btn-secondary ml-2">Volver a mostrar todo</a>
                </div>
            </form>
        </div>
        <br>

        <?php
        $servername = "localhost:3306";
        $cuenta = 'root';
        $password = '';
        $bd = 'goodWatch';
        
        // Conexión a la base de datos
        $conexion = new mysqli($servername, $cuenta, $password, $bd);
        
        if ($conexion->connect_errno) {
            die('Error en la conexión');
        } else {
            // Si se ha enviado la solicitud para eliminar la serie
            if (isset($_GET['delete_id'])) {
                $delete_id = $_GET['delete_id'];

                // Llamamos al procedimiento de eliminación
                $sql = "CALL EliminarSerie('$delete_id')";  // El procedimiento ahora elimina series

                if ($conexion->query($sql)) {
                    echo "<script>
                            Swal.fire(
                                'Eliminada!',
                                'La serie ha sido eliminada.',
                                'success'
                            ).then(() => {
                                window.location.href = 'bajasS.php';
                            });
                          </script>";
                } else {
                    echo "<script>
                            Swal.fire(
                                'Error!',
                                'No se pudo eliminar la serie.',
                                'error'
                            );
                          </script>";
                }
            }

            // Consulta para obtener las series y contar cuántas temporadas tiene cada una
            $search_id = isset($_GET['search_id']) ? $_GET['search_id'] : '';
            $sql = "SELECT FI.ID_FILME, FI.NOMBRE NOMBRE, FI.IMAGEN IMAGEN, FI.DESCRIPCION DESCRIPCION, 
                    COUNT(S.TEMPORADA) AS NUM_TEMPORADAS
                    FROM FILME FI
                    LEFT JOIN SERIE S ON FI.ID_FILME = S.ID_FILME
                    WHERE FI.TIPO_FILME = 'S'";

            if (!empty($search_id)) {
                $sql .= " AND FI.ID_FILME LIKE '%" . $conexion->real_escape_string($search_id) . "%'";
            }

            $sql .= " GROUP BY FI.ID_FILME";

            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<div class="container-flex d-flex">';  
                    echo '  <div class="id-col">' . $fila['ID_FILME'] . '</div>';  
                    echo '  <div class="img-col"><img src="../imagenes/' . $fila['IMAGEN'] . '" class="img-fluid" alt="' . $fila['NOMBRE'] . '"></div>';  
                    echo '  <div class="name-col">';
                    echo '    <strong>' . $fila['NOMBRE'] . '</strong>';  
                    echo '    <p class="desc-col">' . $fila['DESCRIPCION'] . '</p>';  
                    echo '    <p><strong>Número de Temporadas: </strong>' . $fila['NUM_TEMPORADAS'] . '</p>';
                    echo '  </div>';  
                    echo '<div class="btn-col">
                            <button class="btn btn-danger btn-sm d-flex justify-content-center align-items-center" 
                                onclick="confirmDelete(\'' . $fila['ID_FILME'] . '\', \'' . $fila['IMAGEN'] . '\', \'' . htmlspecialchars($fila['NOMBRE'], ENT_QUOTES) . '\')">
                                <i class="fa-solid fa-trash" style="font-size: 20px;"></i>
                            </button>
                        </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No se encontraron series con ese ID.</p>';
            }
        }
        ?>

        <script>
        function confirmDelete(id, imagen, nombre) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta serie será eliminada junto con todas sus temporadas.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarla',
                html: `<div style="text-align: center;">
                        <img src="../imagenes/${imagen}" alt="Imagen de la serie" style="width: 100px; height: auto; margin-bottom: 15px;">
                        <p>¿Quieres eliminar la serie ${nombre}?</p>
                    </div>`
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir a la misma página con el ID de la serie para eliminarla
                    window.location.href = 'bajasS.php?delete_id=' + id;
                }
            });
        }
        </script>

    </div>
</div>       

</body>
</html>
