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
$id_empresa = $_GET['id_empresa_cliente'];
$instruccion = "select * from empresa_cliente where id_empresa_cliente=$id_empresa";
$filas = $conexion->query($instruccion);

foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) {
    $id_empresa = $fila['id_empresa_cliente'];
    $rut = $fila["rut"];
    $nombre_de_empresa = $fila["nombre_de_empresa"];
    $mail = $fila["mail"];
}

?>

<div class="form-crud">
    <form action="modificar.php" method="post">
        <legend class="legend-m-empresa-cliente">Modificar Empresa Cliente</legend>

        <label><b class='p-id'>ID:</b> <?= $id_empresa?></label>
        <input type="text" name="id_empresa_cliente" value="<?=$id_empresa?>" required hidden>

        <label><b class='p-cedula'>RUT: </b></label>
        <input type="text" placeholder="RUT" class="txt-crud txt1" name="rut" value="<?= $rut ?>" required>

        <label><b class='p-nombre'>Nombre: </b></label>
        <input type="text" placeholder="Nombre" class="txt-crud txt2" name="nombre_de_empresa" value="<?= $nombre_de_empresa ?>" required>

        <label><b>Mail: </b></label>
        <input type="mail" placeholder="Mail" class="txt-crud txt3" name="mail" value="<?= $mail ?>" required>
        
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-empresas-cliente.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>