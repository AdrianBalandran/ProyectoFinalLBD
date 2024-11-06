
<?php
    session_start();

    $serv = 'localhost';
    $cuenta = 'root';
    $contra = '';
    $BaseD = 'GOODWATCH';

    //conexion con la base de datos 
    $conexion = new mysqli($serv,$cuenta,$contra,$BaseD);
    if($conexion->connect_error){
        die('Ocurrio un error en la conexion con la BD');
    } else{
        if(isset($_POST['submit'])){
            $usuario = $_POST["user"];
            $password = $_POST["pass"];
    
            
            $cipher = "AES-256-CBC"; 
            $encryption_key = "12345678901234567890123456789012"; 
            $iv = str_repeat("0", openssl_cipher_iv_length($cipher));
        
            
            $encrypted_data = openssl_encrypt($password, $cipher, $encryption_key, 0, $iv);

            $sql = "SELECT *FROM USUARIO WHERE ALIAS='$usuario' AND CONTRASEÑA='$encrypted_data';";
            $resultado = $conexion->query($sql);
            if ($resultado -> num_rows){
                $_SESSION['usuario'] = $usuario;
                $_SESSION['in'] = true;
            }else{
                $_SESSION['mal'] = true;
            }

        }
    }
    header("Location: login.php");


?>