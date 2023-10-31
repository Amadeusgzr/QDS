<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'almacenero') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
        exit();
    }
}
if (!isset($_GET['id_lote']) || is_null($_GET['id_lote']) || empty(trim($_GET['id_lote']))) {
    header("Location: ../error.php");
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>
<?php
$id_lote = $_GET['id_lote'];
require("../../controladores/api/lote/obtenerDatoPorId.php");
foreach ($decode as $lote) {
    $id_lote = $lote["id_lote"];
    $peso = $lote["peso"];
    $volumen = $lote["volumen"];
}
?>
<div class="form-crud">
    <legend class="legend-baja-lote">Eliminar Lote</legend>
    <p class="adv">¿Seguro que quiere eliminar el siguiente lote? Los cambios serán irreversibles</p>
    <p><b class="p-id">ID: </b>
        <?= $id_lote ?>
    </p>
    <p><b class="p-peso">Peso: </b>
        <?= $peso ?> kg
    </p>
    <p><b class="p-volumen">Volumen: </b>
        <?= $volumen ?>
    </p>
    <a href="../../controladores/api/lote/eliminarDato.php?id_lote=<?= $id_lote ?>"><input type="submit" value="Eliminar" class="estilo-boton boton-siguiente boton-eliminar"></a>
    <a href="op-lotes.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>