<?php
    session_start();
    
    unset($_SESSION['usuario']);
    unset($_SESSION['admin']);
    $_SESSION['logout'] = true;
    header("Location: ../index.php");
?>