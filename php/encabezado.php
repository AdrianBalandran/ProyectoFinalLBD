<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/encabezado.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../imagenes/faviconi.png"/>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <!-- Botón de menú hamburguesa -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
                </button>

                <!-- Logo centrado y estático -->
                <a class="navbar-brand mx-auto" href="#"><img src="../imagenes/LogoFinal.png" alt="No Disponible" width="150px" height="auto"></a> 

                <!-- Menú colapsable -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../index.php">INICIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/series.php">SERIES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/peliculas.php">PELÍCULAS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/comunidad.php">COMUNIDAD</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/vertodo.php">TODO</a>
                        </li>
                        <?php 
                        if(isset($_SESSION['usuario'])){?>
                            <li class="nav-item">
                                <a class="nav-link" href="MisVisual.php">MIS FILMES</a>
                            </li>
                        <?php }
                        if(isset($_SESSION['usuario'])){
                            if($_SESSION['usuario'] == "Admin"){?>
                                <li class="nav-item">
                                    <a class="nav-link" href="../php/altasP.php">ADMINISTRADOR</a>
                                </li>
                        <?php }} ?>    
                    </ul>

                    <!-- Barra de búsqueda en el menú colapsable -->
                    <div class="d-flex justify-content-center mb-3 mb-lg-0">
                        <form class="d-flex position-relative" role="search" action="../php/Buscador.php" method="POST">
                            <div class="input-container">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input class="form-control buscar" type="search" placeholder="BUSCAR..." aria-label="Search" name="busca">
                            </div>
                        </form>
                    </div>

                    <!-- Ícono de inicio de sesión / cierre de sesión en el menú colapsable -->
                    <div class="d-flex justify-content-center">
                        <?php 
                            if(!isset($_SESSION['usuario'])){?>
                                <a href="../php/login.php" class="navbar-nav" data-bs-toggle="tooltip" data-bs-title="Iniciar Sesión">
                                    <span class="nav-link">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                </a>
                            <?php } elseif(isset($_SESSION['usuario'])){ ?>
                                <a href="../php/logout.php" class="navbar-nav" data-bs-toggle="tooltip" data-bs-title="Cerrar Sesión">
                                    <span class="nav-link">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                    </span>
                                </a>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f3a304d792.js" crossorigin="anonymous"></script>
</body>
</html>
