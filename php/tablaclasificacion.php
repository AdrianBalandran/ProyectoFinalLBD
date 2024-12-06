<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/estilosclasi.css">
    <script src="https://kit.fontawesome.com/f3a304d792.js" crossorigin="anonymous"></script>
    <title>Clasificaciones de Filmes</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <!-- Fuentes de letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
        
</head>

<body>

<div class="d-flex flex-nowrap">
    <?php include "../html/panelLateral.html"; ?>
    <script>
        document.getElementById("estaclasi-op").style.backgroundColor = "#5ae2a8";
    </script>
    <div class="d-flex flex-column contenido">

        <section class="todocont">
            <div class="table-container">
                <h1 class="header-title">Clasificaciones y Estrenos de Filmes</h1>
                <table id="filmsTable" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Clasificación</th>
                            <th>Año de Estreno</th>
                            <th>Cantidad de Filmes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Datos de conexión a la base de datos
                        $servername = 'localhost';
                        $cuenta = 'root';
                        $password = '';
                        $bd = 'goodWatch';

                        // Conexión a la base de datos
                        $conexion = new mysqli($servername, $cuenta, $password, $bd);

                        if ($conexion->connect_errno) {
                            die('Error en la conexión: ' . $conexion->connect_error);
                        }

                        // Consulta para obtener clasificaciones y estrenos
                        $consulta = "
                            SELECT FI.CLASIFICACION, YEAR(FI.FECHA_ESTRENO) AS ANO_ESTRENO, COUNT(*) AS TOTAL_FILMES
                            FROM FILME FI
                            GROUP BY FI.CLASIFICACION, YEAR(FI.FECHA_ESTRENO)
                            ORDER BY FI.CLASIFICACION, ANO_ESTRENO;
                        ";

                        $resultado = $conexion->query($consulta);

                        if ($resultado->num_rows > 0) {
                            while ($fila = $resultado->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $fila['CLASIFICACION'] . "</td>";
                                echo "<td>" . $fila['ANO_ESTRENO'] . "</td>";
                                echo "<td>" . $fila['TOTAL_FILMES'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No se encontraron resultados.</td></tr>";
                        }

                        $conexion->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</div>

<!-- Script para activar DataTables y la paginación -->

<script>
    $(document).ready(function () {
    $('#filmsTable').DataTable({
        "paging": true,
        "pageLength": 10,
        "lengthChange": false,
        "processing": true,
        "serverSide": false,
        "ordering": true,
        "language": {
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            },
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "zeroRecords": "No se encontraron resultados",
            "search": "Buscar:"
        }
    });
});

</script>

</body>
</html>
