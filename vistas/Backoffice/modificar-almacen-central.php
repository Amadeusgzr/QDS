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

<?php
include("../../modelos/db.php");
$id_almacen_central = $_GET['id_almacen_central'];
$instruccion = "select * from almacen_central where id_almacen_central=$id_almacen_central";
$filas = $conexion->query($instruccion);

foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
    $id_almacen_central = $fila["id_almacen_central"];
    $telefono = $fila["telefono"];
    $numero_almacen = $fila["numero_almacen"];
}
?>

<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend class="legend-m-almacen-central">Modificar Almacén (central)</legend>
        
        <label><b class='p-id'>ID:</b> <?= $id_almacen_central?></label>

        <label><b class="p-telefono">Teléfono: </b></label>
        <input type="tel" placeholder="Teléfono" class="txt-crud txt1" name="telefono" value="<?= $telefono ?>" required>

        <label><b class="p-numero-almacen">Número de almacén: </b></label>
        <input type="text" placeholder="Número de almacén" class="txt-crud txt2" name="numero_almacen" value="<?= $numero_almacen ?>" required>
        
        
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-almacen-central.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>