<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoodWatch | Series</title>
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/series.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Fuentes de letra -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <header>
        <?php include("encabezado.php"); ?>
    </header>

    <div class="peliculas-sec">
        <form action="Info_Series.php" method="POST" id="formulario" class="form">
            <div class="colocacion">
                <?php
                $servername = 'localhost';
                $cuenta = 'root';
                $password = '';
                $bd = 'goodWatch';
                $conexion = new mysqli($servername, $cuenta, $password, $bd);
                if ($conexion->connect_errno) {
                    die('Error en la conexion');
                }

                // Paginación
                $registrosPorPagina = 6; // Cambia según cuántas series mostrar por página
                $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                $offset = ($paginaActual - 1) * $registrosPorPagina;

                // Obtener series con limit y offset
                $sql = "SELECT FI.NOMBRE NOMBRE, S.IMAGENTEM IMAGEN, FI.CLASIFICACION CLASIFICACION, 
                            S.FECHA_ESTRENO FECHA_ESTRENO, S.NUMERO_EPISODIOS EPISODIOS, S.TEMPORADA TEMPORADA, FI.ID_FILME 
                        FROM FILME FI, SERIE S 
                        WHERE FI.ID_FILME = S.ID_FILME 
                        LIMIT $registrosPorPagina OFFSET $offset";
                $resultado = $conexion->query($sql);

                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        $fechaEstreno = new DateTime($fila['FECHA_ESTRENO']);
                        $fechaFormateada = $fechaEstreno->format('d/m/Y');
                ?>
                        <button name="submit" type="submit" value="<?php echo $fila['ID_FILME']; ?>+<?php echo $fila['TEMPORADA']; ?>">
                            <div class="card-sep">
                                <div class="card border-dark mb-3 card-size">
                                    <img src="../imagenes/<?php echo $fila['IMAGEN']; ?>" class="card-img-top" alt="Imagen de serie">
                                    <div class="card-body nbcolor d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title"><?php echo $fila['NOMBRE']; ?></h5>
                                            <h4><?php echo $fechaFormateada; ?></h4>
                                            <div class="npcolor">
                                                <p class="card-text"><?php echo $fila['CLASIFICACION']; ?></p>
                                            </div>
                                        </div>
                                        <div class="infoserie">
                                            <h4>TEMPORADA <?php echo $fila['TEMPORADA']; ?></h4>
                                            <h4><?php echo $fila['EPISODIOS']; ?> EPISODIOS</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </button>
                <?php
                    }
                } else {
                    echo "<p>No se encontraron series.</p>";
                }
                ?>
            </div>
        </form>
    </div>

    <!-- Paginación -->
    <div class="paginacion">
        <nav aria-label="Paginación">
            <ul class="pagination pagination-lg justify-content-center">
                <?php
                // Obtener el número total de registros
                $sqlTotal = "SELECT COUNT(*) AS total FROM FILME FI, SERIE S WHERE FI.ID_FILME = S.ID_FILME";
                $resultadoTotal = $conexion->query($sqlTotal);
                $totalRegistros = $resultadoTotal->fetch_assoc()['total'];
                $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

                for ($i = 1; $i <= $totalPaginas; $i++) {
                    $active = $i == $paginaActual ? 'active' : '';
                    echo "<li class='page-item $active'><a class='page-link' href='?pagina=$i'>$i</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>

</body>
<?php include("footer.php"); ?>
</html>
