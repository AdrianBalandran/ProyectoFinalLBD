<!DOCTYPE html>
<html lang="es">
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
    <div class="d-flex flex-column contenido">
        <h2 style="margin: 0 auto; padding-bottom: 30px;">Bajas de Temporadas</h2>

        <div class="text-end">
            <form method="GET" action="">
                <div class="d-flex justify-content-end align-items-center">
                    <input type="text" name="search_id" class="form-control" placeholder="Buscar por ID de serie" style="width: 200px;">
                    <button type="submit" class="btn btn-primary ml-2" style="margin-right:10px">Buscar</button>
                    <!-- Botón para mostrar todos los registros, alineado al lado del campo de búsqueda -->
                    <a href="bajasT.php" class="btn btn-secondary ml-2">Volver a mostrar todo</a>
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
            // Eliminar temporada si se pasa el parámetro de eliminación
            if (isset($_GET['delete_id']) && isset($_GET['temporada'])) {
                $id_filme = $_GET['delete_id'];
                $temporada = $_GET['temporada'];

                // Llamar al procedimiento almacenado para eliminar la temporada
                $sql_delete = "CALL EliminarTemporada('$id_filme', $temporada)";

                if ($conexion->query($sql_delete) === TRUE) {
                    echo "<script>
                        Swal.fire(
                            'Eliminada!',
                            'La temporada ha sido eliminada.',
                            'success'
                        ).then(() => {
                            window.location.href = 'bajasT.php';
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire(
                            'Error!',
                            'No se pudo eliminar la temporada.',
                            'error'
                        );
                    </script>";
                }
            }

            // Consulta para obtener las series con sus temporadas
            $search_id = isset($_GET['search_id']) ? $_GET['search_id'] : '';
            $sql = "SELECT FI.NOMBRE, S.IMAGENTEM, S.TEMPORADA, FI.ID_FILME
                    FROM FILME FI
                    JOIN SERIE S ON FI.ID_FILME = S.ID_FILME";

            if (!empty($search_id)) {
                $sql .= " WHERE FI.ID_FILME LIKE '%" . $conexion->real_escape_string($search_id) . "%'";
            }

            $resultado = $conexion->query($sql);

            
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<div class="container-flex d-flex" style="border: 1px solid #ccc; padding: 20px; margin-bottom: 20px;">';  
                    echo '  <div class="id-col" style="width: 100px; padding-right: 20px;">' . $fila['ID_FILME'] . '</div>';
                    echo '  <div class="img-col" style="width: 150px; height: auto; margin-right: 20px;">';
                    echo '    <img src="../imagenes/' . $fila['IMAGENTEM'] . '" class="img-fluid" alt="' . $fila['NOMBRE'] . '">';
                    echo '  </div>';
                    echo '  <div class="name-col" style="flex-grow: 1;">';
                    echo '    <strong>' . $fila['NOMBRE'] . '</strong>';
                    echo '    <p><strong>Temporada: </strong>' . $fila['TEMPORADA'] . '</p>';
                    echo '  </div>';
                    echo '  <div class="btn-col" style="display: flex; align-items: center; justify-content: center; width: 50px;">';
                    echo '    <button class="btn btn-danger btn-sm" 
                            onclick="confirmDelete(\'' . $fila['ID_FILME'] . '\', \'' . $fila['TEMPORADA'] . '\', \'' . $fila['IMAGENTEM'] . '\')">
                            <i class="fa-solid fa-trash" style="font-size: 20px;"></i>
                        </button>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No se encontraron series con ese ID.</p>';
            }
        }
        ?>

        <script>
        function confirmDelete(id, temporada, imagen) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta temporada será eliminada.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarla',
                html: `<div style="text-align: center;">
                            <img src="../imagenes/${imagen}" alt="Imagen de la temporada" style="width: 100px; height: auto; margin-bottom: 15px;">
                            <p>¿Quieres eliminar la temporada ${temporada}?</p>
                        </div>`
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir a la misma página con el ID de la serie y la temporada para eliminarla
                    window.location.href = 'bajasT.php?delete_id=' + id + '&temporada=' + temporada;
                }
            });
        }
        </script>

    </div>
</div>       

</body>
</html>
