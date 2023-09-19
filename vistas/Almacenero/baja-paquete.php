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
        <legend>Eliminar Paquete</legend>
        <p class="adv">¿Seguro que quiere eliminar el siguiente paquete? Los cambios serán irreversibles</p>
        <p><b>ID: </b>"34643"</p>
        <p><b>Peso: </b>"435 Kg"</p>
        <p><b>Volumen: </b>"43534"</p>
        <p><b>Camión asignado: </b>"STP 1234"</p>
        <a href=""><input type="submit" value="Eliminar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-paquetes.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>