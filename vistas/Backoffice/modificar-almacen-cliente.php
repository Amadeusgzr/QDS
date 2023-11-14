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
$id_almacen_cliente = $_GET['id_almacen_cliente'];
$instruccion = "select * from almacen_cliente where id_almacen_cliente=$id_almacen_cliente";
$filas = $conexion->query($instruccion);

foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
    $id_almacen_cliente = $fila["id_almacen_cliente"];
    $telefono = $fila["telefono"];
    $direccion = $fila["direccion"];
}
?>

<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend class="legend-m-almacen-cliente">Modificar Almacén (cliente)</legend>

        <label><b class='p-id'>ID:</b> <?= $id_almacen_cliente?></label>

        <label><b class='p-telefono'>Teléfono: </b></label>
        <input type="tel" placeholder="Teléfono" class="txt-crud txt1" name="telefono" value="<?= $telefono ?>" required>

        <label><b class='p-direccion'>Dirección: </b></label>
        <input type="text" placeholder="Dirección" class="txt-crud txt2" name="direccion" value="<?= $direccion ?>" required>
        
        
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-almacen-cliente.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>