<body>

  <?php
    $cipher = "AES-256-CBC"; 
    $encryption_key = "12345678901234567890123456789012"; 
    $iv = str_repeat("0", openssl_cipher_iv_length($cipher));

    $serv = 'localhost';
    $cuenta = 'root';
    $contra = '';
    $BaseD = 'GOODWATCH';

   //conexion con la base de datos 
    $conexion = new mysqli($serv,$cuenta,$contra,$BaseD);
   if($conexion->connect_error){
       die('Ocurrio un error en la conexion con la BD');
   }else{
        if(isset($_POST['submit'])){
            session_start();

            $usuario = $_POST["user"];
            $nombre =$_POST["name"];
            $email =$_POST["email"];
            $telefono = $_POST["tel"];
            $password = $_POST["pass"];
            $password1 = $_POST["pass1"];

            if($password != $password1){
              $_SESSION['cont'] = true;
              header("Location: registro.php");
            }

            $encrypted_data = openssl_encrypt($password, $cipher, $encryption_key, 0, $iv);

            $flag = true;
            $sql = 'select * from USUARIO';//hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
            $resultado = $conexion -> query($sql); //aplicamos sentencia
            if ($resultado -> num_rows){ //si la consulta genera registros
                while( $fila = $resultado -> fetch_assoc()){ //recorremos los registros obtenidos de la tabla
                  $flag = true;
                  if($usuario == $fila['ALIAS']){
                    $_SESSION['repetido'] = true;
                    header("Location: registro.php");
                  } 
                }
            }

            if($flag && !isset($_SESSION['cont'])){     
              $sql = "INSERT INTO USUARIO(ID_USUARIO, NOMBRE, ALIAS, EMAIL, TELEFONO, CONTRASEÑA) VALUES(nextval(Usuario_Id),'$nombre','$usuario','$email','$telefono', '$encrypted_data');";
              // $sql = "SELECT *FROM USUARIO;";
              $resultado = $conexion->query($sql);

              if ($conexion->affected_rows >= 1){ 
                  echo "registro insertado" ;
                      
              }
                $_SESSION['usuario'] = $usuario;
                $_SESSION['insertar'] = true;
                //Cambiar a la pagina de inicio
                header("Location: registro.php");
            }
        }   
   }

  // mysql_close($conexion);
 ?>
</body>