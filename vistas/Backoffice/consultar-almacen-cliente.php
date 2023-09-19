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
    <legend>Consultar Almacén (cliente)</legend>
    <p class="subtitulo-crud">Datos del almacén</p>
        <p><b>ID: </b>"147"</p>
        <p><b>Teléfono: </b>"2525 2525"</p>
        <p><b>Dirección: </b>"narnia"</p>
    <a href="almacen-cliente.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>