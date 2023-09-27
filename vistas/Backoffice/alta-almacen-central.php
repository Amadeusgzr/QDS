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
    <form action="alta-almacen-central.php" method="post">
        <legend>Agregar Almacén Central</legend>
        <input type="text" placeholder="Teléfono" class="txt-crud" name="telefono" required>
        <input type="tel" placeholder="Dirección" class="txt-crud" name="direccion" required>
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-almacen-central.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php


if ($_POST) {
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];



    include("../../modelos/db.php");
    $instruccion = "insert into almacen_central(direccion, telefono) value ('$direccion', '$telefono')";
    $conexion->query($instruccion);
}

?>