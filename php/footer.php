<?php 

$servidor='localhost';
$cuenta='root';
$password='';
$bd='GOODWATCH';

//conexion a la base de datos
$conexion = new mysqli($servidor, $cuenta, $password, $bd);

if($conexion->connect_errno) {
    die('Error en la conexion');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->

    <title>Info</title>
    <script src="https://kit.fontawesome.com/ea44ba5a78.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">


</head>
<!-- <div class="linefooter"></div> -->

<footer class="footer">
    <h2 class="titulo">GoodWatch</h2>
    <div class="linea"></div>
    <div class="links">
        <div class="Primera">
            <p> <a href="peliculas.php">Películas</a></p>
            <p><a href="series.php">Series</a></p>
        </div>
        <div class="Segunda">
            <p><a href="MisVisual.php">Mis filmes</a></p>
            <p><a href="comunidad.php">Comunidad</a></p>
        </div>

    </div>
    <section class="secFooter">
        <div class="logos">
            <span><i class="fa-brands fa-facebook"></i></span>
            <span><i class="fa-brands fa-instagram"></i></span>
            <span><i class="fa-brands fa-x-twitter"></i></span>
        </div>
        <di class="derechos"v>
            <p>© 2024 GoodWatch. Todos los derechos reservados.</p>
            <p class="pequeno">Universidad Autónoma de Aguascalientes - ISC 7A</p>
        </di>
    </section>
</footer>

</html>