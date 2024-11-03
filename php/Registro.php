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

</head>

<body>
    <main>
        
        <section class="div_Registro">
            <h2>Crear cuenta</h2>
            <div class="linea"></div>
            <form class="form" action="Registro_insertar.php" method="post">
                    <div class="col-md-6">
                        <label for="alias" class="form-label">Alias:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="user" class="form-control" id="user"  required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="tel" class="form-label">Teléfono:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-phone" ></i></span>
                            <input type="tel" name="tel" class="form-control" id="tel" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="pass" class="form-label">Contraseña:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-lock" ></i></span>
                            <input type="password" name="pass" class="form-control" id="pass" required>
                        </div>
                    </div>

                    <div class="col-md-6 error">
                        <label for="pass" class="form-label">Repetir contraseña:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-lock" ></i></span>
                            <input type="password" name="pass1" class="form-control" id="pass1" required>
                        </div>
                        <small id="formulario_error">Ambas contraseñas deben ser iguales</small>
                    </div>
                    

                    <div class="button">
                        <button type="submit" name="submit" class="btn btn-primary">Crear</button>
                    </div>
            </form>
        </section>
    </main>
    <script src="../js/script_Registro.js"></script>

</body>
</html>