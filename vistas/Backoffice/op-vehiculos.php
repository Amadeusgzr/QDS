<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>

<h1 class="h1-titulo">Camiones y Camionetas</h1>

<div class="div-opciones-columna">
    <a href="index.php"><button class="boton-volver estilo-boton">Volver</button></a>
    <a href="op-camiones.php" class="opcion-aplicacion" id="op1">
        <h2>Camiones</h2>
    </a>
    <a href="op-camionetas.php" class="opcion-aplicacion" id="op1">
        <h2>Camionetas</h2>
    </a>
</div>