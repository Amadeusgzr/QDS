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
    $cant_paquetes = $lote["cant_paquetes"];
    $peso = $lote["peso"];
    $volumen = $lote["volumen"];
    $fragil = $lote["fragil"];
    $tipo = $lote["tipo"];
    $detalles = $lote["detalles"];
}

?>
<div class="form-crud">
    <form action="../../controladores/api/lote/modificarDato.php" method="post">
        <legend class="legend-m-lote">Modificar Lote</legend>
        <label><b class="p-id">ID: </b><?= $id_lote ?></label>

        <label><b class="p-cant-paquetes">Cantidad de paquetes: </b></label>
        <input type="tel" placeholder="Cantidad de paquetes" class="txt-crud txt1" name="cant_paquetes" value="<?= $cant_paquetes ?>" required>
        
        <label><b class="p-peso">Peso: </b></label>
        <input type="text" placeholder="Peso" class="txt-crud txt2" name="peso" value="<?= $peso ?>" required>
        
        <label><b class="p-volumen">Volumen: </b></label>
        <input type="text" placeholder="Volumen" class="txt-crud txt3" name="volumen" value="<?= $volumen ?>" required>
        
        <label><b class="p-fragil">Fragil: </b></label>
        <input type="text" placeholder="Fragil" class="txt-crud txt4" name="fragil" value="<?= $fragil ?>" required>

        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-lotes.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
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

</div>