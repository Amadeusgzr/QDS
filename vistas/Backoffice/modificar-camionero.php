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
$id_camionero = $_GET['id_camionero'];
$instruccion = "select * from camionero where id_camionero=$id_camionero";
$filas = $conexion->query($instruccion);

foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
    $id_camionero = $fila["id_camionero"];
    $cedula = $fila["cedula"];
    $nombre_completo = $fila["nombre_completo"];
    $estado = $fila["estado"];
    $mail = $fila["mail"];
    $telefono = $fila["telefono"];
}

?>
<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend class="legend-m-camionero">Modificar Camionero</legend>
        <label><b class='p-id'>ID:</b> <?= $id_camionero ?></label>
        <input type="text" name="id_camionero" value="<?=$id_camionero?>" required hidden>

        <label><b class='p-cedula'>Cédula: </b></label>
        <input type="text" placeholder="Cédula" class="txt-crud" name="cedula" value="<?= $cedula ?>" required maxlength="8">

        <label><b class='p-nombre'>Nombre: </b></label>
        <input type="text" placeholder="Nombre Completo" class="txt-crud" name="nombre_completo"
            value="<?= $nombre_completo ?>" required maxlength="45">

        <label><b class='p-telefono'>Teléfono: </b></label>
        <input type="tel" placeholder="Teléfono" class="txt-crud" name="telefono" value="<?= $telefono ?>" required maxlength="20">

        <label><b class='p-telefono'>Mail: </b></label>
        <input type="mail" placeholder="Mail" class="txt-crud" name="mail" value="<?= $mail ?>" required maxlength="45">
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-camioneros.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>

<div class="div-error">
    <?php
    if (isset($_GET['datos'])) {
        $jsonDatos = urldecode($_GET['datos']);
        $datos = json_decode($jsonDatos, true);
        echo $datos['respuesta'];
    }
    ?>
</div>

<script src="../js/mostrar-respuesta.js"></script>
<script src="../js/ocultar-get-modificar.js"></script>