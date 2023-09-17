<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>

<h1 id="h1-camioneros">Gestión de Camiones</h1>

<div class="boton-de-opcion">
    <a href="aplicacion-administrador.php"><button class="estilo-boton boton-volver">Volver</button></a>
</div>

<main class="main-aplicacion">
    <a href="alta-camion.php" class="opcion-aplicacion-2" id="op1">
        <h2>Alta</h2>
        <p>Ingresar un nuevo Camión al sistema</p>
    </a>
    <a href="baja-camion.php" class="opcion-aplicacion-2" id="op2">
        <h2>Baja</h2>
        <p>Eliminar un Camión del sistema</p>
    </a>
    <a href="modificar-camion.php" class="opcion-aplicacion-2" id="op3">
        <h2>Modificación</h2>
        <p>Modificar un Camión del sistema</p>
    </a>
    <a href="consultar-camion.php" class="opcion-aplicacion-2" id="op4">
        <h2>Consulta</h2>
        <p>Consultar los datos de uno o varios Camiones</p>
    </a>
</main>