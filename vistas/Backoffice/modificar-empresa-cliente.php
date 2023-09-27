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
$rut = $_GET['rut'];
$instruccion = "select * from empresa_cliente where rut=$rut";
$filas = $conexion->query($instruccion);

foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
    $rut = $fila["rut"];
    $nombre_de_empresa = $fila["nombre_de_empresa"];
    $mail = $fila["mail"];
}

?>

<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend>Modificar Empresa Cliente</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p><b>RUT: </b>
            <?= $rut ?>
        </p>
        <p><b>Nombre: </b>
            <?= $nombre_de_empresa ?>
        </p>
        <p><b>Mail: </b>
            <?= $mail ?>
        </p>
        <p class="subtitulo-crud">Datos modificados</p>
        <input type="text" placeholder="RUT" class="txt-crud" name="rut" value="<?= $rut ?>" required readonly>
        <input type="tel" placeholder="Nombre" class="txt-crud" name="nombre_de_empresa"
            value="<?= $nombre_de_empresa ?>" required>
        <input type="mail" placeholder="Mail" class="txt-crud" name="mail" value="<?= $mail ?>" required>
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-empresas.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>