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
    <form action="alta-camion.php" method="post">
        <legend>Agregar Camión</legend>
        <input type="text" placeholder="Matrícula" class="txt-crud" name="matricula">
        <input type="text" placeholder="Peso max. (Kg)" class="txt-crud" name="peso_soportado">
        <input type="text" placeholder="Volumen max. (Mts3)" class="txt-crud" name="volumen_disponible">
        <a href=""><input type="submit" value="Agregar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-camiones.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<?php


if($_POST){
    $matricula = $_POST["matricula"];
    $volumen_disponible = $_POST["volumen_disponible"];
    $peso_soportado = $_POST["peso_soportado"];

    $conexion = new mysqli("127.0.0.1","root","","logistic");
    $instruccion = "insert into camion(matricula, volumen_disponible, peso_soportado) value ('$matricula', '$volumen_disponible', '$peso_soportado')";
    $conexion->query($instruccion);
}

?>