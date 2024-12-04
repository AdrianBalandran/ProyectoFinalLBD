<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasificaciones de Filmes</title>

 <!-- Estilos -->
 <link rel="stylesheet" href="../css/estilosclasi.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Fuentes de letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://kit.fontawesome.com/f3a304d792.js" crossorigin="anonymous"></script>
    
</head>



<body>
       <!-- Encabezado -->
   <header>
        <?php
            include ("encabezado.php");
        ?>
    </header>

<section class="todocont">


<h1 class="header-title">Clasificaciones y Estrenos de Filmes</h1>

<div class="table-container">
    <table class="table table-striped table-bordered">
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

<!-- Pie de página -->
<footer>
        <?php
        include ("footer.php");
        ?>
    </footer>
    
</body>



</html>
