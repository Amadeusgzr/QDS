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

<div class="form-crud">
    <legend>Consultar Paquete</legend>
    <p class="subtitulo-crud">Datos del camión</p>
        <p><b>ID: </b>"42643"</p>
        <p><b>Remitente: </b>"CRECOM"</p>
        <p><b>Dirección: </b>"casa"</p>
        <p><b>Camión asignado: </b>"STP 1234"</p>
        <p><b>Chofer: </b>"Carlos Pérez"</p>
        <p><b>Estado: </b>"En camino"</p>
    <a href="op-paquetes.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>