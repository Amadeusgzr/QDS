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
        $direccion = $fila["direccion"];
    }

    if (isset($_GET["telefono"])) {
        $id_almacen_central = $_GET["id_almacen_central"];
        $telefono = $_GET["telefono"];
        $direccion = $_GET["direccion"];


        $instruccion1 = "update almacen_central set direccion='$direccion', telefono='$telefono' where id_almacen_central=$id_almacen_central";
        $conexion->query($instruccion1);
    }

    ?>

<div class="form-crud">
    <form action="modificar-almacen-central.php" method="get">
        <legend>Modificar Almacén (central)</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p><b>ID: </b><?= $id_almacen_central?></p>
        <p><b>Teléfono: </b><?= $telefono?></p>
        <p><b>Dirección: </b><?= $direccion?></p>
        <p class="subtitulo-crud">Datos modificados</p>
        <input type="text" placeholder="ID" class="txt-crud" name="id_almacen_central" value="<?= $id_almacen_central?>" required readonly>
        <input type="tel" placeholder="Teléfono" class="txt-crud" name="telefono" value="<?= $telefono?>" required>
        <input type="text" placeholder="Dirección" class="txt-crud" name="direccion" value="<?= $direccion?>" required>
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-almacen-central.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>