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
    <form action="alta-empresa-cliente.php" method="post">
        <legend>Agregar Empresa Cliente</legend>
        <input type="text" placeholder="RUT" class="txt-crud" name="rut" required>
        <input type="text" placeholder="Nombre" class="txt-crud" name="nombre_de_empresa" required>
        <input type="tel" placeholder="Mail" class="txt-crud" name="mail" required>
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-empresas.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php


if ($_POST) {
    $rut = $_POST["rut"];
    $nombre_de_empresa = $_POST["nombre_de_empresa"];
    $mail = $_POST["mail"];



    include("../../modelos/db.php");
    $instruccion = "insert into empresa_cliente(rut, nombre_de_empresa, mail) value ('$rut', '$nombre_de_empresa', '$mail')";
    $conexion->query($instruccion);
}

?>