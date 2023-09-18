<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
if($_GET['cedula']){
        $cedula = $_GET['cedula'];
        $conexion = new mysqli("127.0.0.1","root","","logistic");

        $instruccion = "delete from camionero where cedula=$cedula";
        $conexion->query($instruccion);
        header("Location: op-camioneros.php");
    }   

?>