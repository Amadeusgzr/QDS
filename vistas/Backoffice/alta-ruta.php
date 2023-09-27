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
    <form action="alta-ruta.php" method="post">
        <legend>Agregar Ruta</legend>
        <input type="text" placeholder="Nombre/Numero" class="txt-crud" name="nom_ruta">
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-ruta.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php


if ($_POST) {
    $nom_ruta = $_POST["nom_ruta"];

    include("../../modelos/db.php");
    $instruccion = "insert into ruta(nom_ruta) value ('$nom_ruta')";
    $conexion->query($instruccion);
}

?>