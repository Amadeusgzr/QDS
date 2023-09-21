<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'almacenero') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
        exit();
    }
}
if (!isset($_GET['id_lote']) || is_null($_GET['id_lote']) || empty(trim($_GET['id_lote']))){
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
        <legend>Modificar Lote</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p><b>ID: </b><?= $id_lote?></p>
        <p><b>Cantidad de paquetes: </b><?= $cant_paquetes?></p>
        <p><b>Peso: </b><?= $peso?> Kg</p>
        <p><b>Volumen: </b><?= $volumen?> Cm3</p>
        <p><b>Fragil: </b><?= $fragil?></p>
        <p class="subtitulo-crud">Datos modificados</p>
        <input type="text" placeholder="ID" class="txt-crud" name="id_lote" value="<?= $id_lote?>" required readonly>
        <input type="tel" placeholder="Cantidad de paquetes" class="txt-crud" name="cant_paquetes" value="<?= $cant_paquetes?>" required>
        <input type="text" placeholder="Peso" class="txt-crud" name="peso" value="<?= $peso?>" required>
        <input type="text" placeholder="Volumen" class="txt-crud" name="volumen" value="<?= $volumen?>" required>
        <input type="text" placeholder="Fragil" class="txt-crud" name="fragil" value="<?= $fragil?>" required>
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-lotes.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
    <?php
if (isset($_GET['datos'])) {
        $jsonDatos = urldecode($_GET['datos']);
        $datos = json_decode($jsonDatos, true);
        echo $datos['error'] . " ";
        echo $datos['respuesta'];
    }
?>
<script src="../js/ocultar-get.js"></script>

</div>