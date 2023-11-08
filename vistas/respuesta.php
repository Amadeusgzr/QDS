<?php
if ($_POST){
        require ("../modelos/db.php");
        $ip = $_SERVER["REMOTE_ADDR"];
        $nombre = $_POST["nombre"];
        $mensaje = $_POST["mensaje"];
        
        $instruccion = "INSERT INTO mensajes (ip,mensaje,nombre) VALUES ('$ip','$mensaje','$nombre')";
        mysqli_query($conexion, $instruccion);
        header("Location: ../index.php");
    }
?>