<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'almacenero') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
        exit();
    }
}
if (!isset($_GET['id_paquete']) || is_null($_GET['id_paquete']) || empty(trim($_GET['id_paquete']))) {
    header("Location: ../error.php");
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';
?>
<?php
$id_paquete = $_GET['id_paquete'];
require("../../controladores/api/paquete/obtenerDatoPorId.php");
foreach ($decode as $paquete) {
    $id_paquete = $paquete["id_paquete"];
    $direccion = $paquete["direccion"];
    $peso = $paquete["peso"];
    $volumen = $paquete["volumen"];
    $fragil = $paquete["fragil"];
    $tipo = $paquete["tipo"];
    $estado = $paquete["paquete_estado"];
}
?>
<script>
    // Función para ocultar el parámetro "datos" en la URL
    function ocultarDatosEnURL() {
        if (window.history.replaceState) {
            // Reemplaza la URL actual sin el parámetro "datos"
            const urlSinDatos = window.location.href.replace(/\?datos=.*&/, '?').replace(/\&datos=.*$/, '');
            window.history.replaceState(null, null, urlSinDatos);
        }
    }

    // Llama a la función al cargar la página
    window.onload = ocultarDatosEnURL;
</script>



<div class="form-crud">
    <form action="../../controladores/api/paquete/modificarDato.php" method="post">
        <legend class="legend-m-paquete">Modificar Paquete</legend>
        <label><b class='p-id'>ID:</b> <?= $id_paquete ?></label>

        <label><b class='p-direccion'>Dirección: </b></label>
        <input type="tel" placeholder="Direccion" class="txt-crud" name="direccion" value="<?= $direccion ?>" required>

        <label><b class='p-peso'>Peso: </b></label>
        <input type="number" placeholder="Peso" class="txt-crud" name="peso" value="<?= $peso ?>" required>

        <label><b class='p-volumen'>Volumen: </b></label>
        <input type="number" placeholder="Volumen" class="txt-crud" name="volumen" value="<?= $volumen ?>" required>

        <label><b class='p-fragil'>Fragil: </b></label>
        <input type="text" placeholder="Fragil" class="txt-crud" name="fragil" value="<?= $fragil ?>" required>

        <?php
        if ($fragil == "Si") {
        echo "<label><b class='p-tipo'>Tipo: </b>$tipo</label>";
        }
        ?>
        <label><b class='p-estado'>Estado: </b><?= $estado ?></label>

        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-paquetes.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
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