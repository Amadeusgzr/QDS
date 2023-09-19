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
    <form action="">
        <legend>Modificar Almacén (cliente)</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p><b>Teléfono: </b>"2525 2525"</p>
        <p><b>Dirección: </b>"narnia"</p>
        <p class="subtitulo-crud">Datos modificados</p>
        <input type="tel" placeholder="Teléfono" class="txt-crud" require>
        <input type="text" placeholder="Dirección" class="txt-crud" require>
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="almacen-cliente.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>