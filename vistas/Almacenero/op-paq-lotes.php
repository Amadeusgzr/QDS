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

<h1 id="h1-camioneros">Paquetes y Lotes</h1>

<div class="div-opciones-columna">
    <a href="../Almacenero/op-paquetes.php" class="opcion-aplicacion" id="op1">
        <h2>Paquetes</h2>
    </a>
    <a href="op-lotes.php" class="opcion-aplicacion" id="op1">
        <h2>Lotes</h2>
    </a>
</div>