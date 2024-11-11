<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->

    <title>Info</title>

    <link rel="stylesheet" href="../css/styleLog.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ea44ba5a78.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</>
<body>
    <header>
        <?php
            include ("encabezado.php");
        ?>
    </header>
    <main class="MainLogin">
        
        <section class="div_Registro div_Login">
            <h2>Inicia Sesión</h2>
            <div class="linea"></div>
            <form class="form" action="login_entrar.php" method="post">
                    <div class="col-md-6">
                        <label for="alias" class="form-label">Alias:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="user" class="form-control" id="user"  required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="pass" class="form-label">Contraseña:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            <input type="password" name="pass" class="form-control" id="pass" required>
                        </div>
                    </div>

                    <div class="button">
                        <button type="submit" name="submit" class="btn btn-primary">Entrar</button>
                    </div>
            </form>
            <h4 class="registro">¿No tienes cuenta? <a href="registro.php">Regístrate</a></h4>
        </section>
    </main>

</body>
<?php 
    include ("../php/footer.php");
?>
</html>

<?php 
session_start();

// Ha ingresado el usuario a su cuenta
    if(isset($_SESSION['in'])){
        unset($_SESSION['in']);
        ?>
        <script>
            Swal.fire({
            icon: "success",
            title: "¡Felicidades!",
            text: "¡Haz ingresado a tu cuenta <?php echo $_SESSION['usuario']; ?>!",
            background: "#fff",
            backdrop: `
            rgba(107, 107, 107,0.2)
            url("../imagenes/star.gif")
            left top
            no-repeat
            `

            }).then((result) => {
            if (result.isConfirmed) {
                location. assign('../index.php')
            }});
        </script>
        <?php 
    }
    if(isset($_SESSION['mal'])){
        unset($_SESSION['mal']);
        ?>
        <script>
            Swal.fire({
            icon: "error",
            title: "Los datos no son correctos",
            text: "Vuelve a introducirlos.",
            })          
        </script>
        <?php
    }

?>
