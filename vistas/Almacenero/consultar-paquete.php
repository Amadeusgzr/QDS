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
    $mail_destinatario = $paquete["mail_destinatario"];
    $direccion = $paquete["direccion"];
    $peso = $paquete["peso"];
    $volumen = $paquete["volumen"];
    $fragil = $paquete["fragil"];
    $tipo = $paquete["tipo"];
    $estado = $paquete["estado"];
    $detalles = $paquete["detalles"];
}
?>
<div class="form-crud">
    <legend class="legend-c-paquete">Consultar Paquete</legend>
    <p class="subtitulo-crud">Datos del paquete</p>
    <p><b class="p-id">ID: </b>
        <?= $id_paquete ?>
    </p>
    <p><b class="p-mail-d">Mail del destinatario: </b>
        <?= $mail_destinatario ?>
    </p>
    <p><b class="p-direccion">Dirección: </b>
        <?= $direccion ?>
    </p>
    <p><b class="p-peso">Peso: </b>
        <?= $peso ?> Kg
    </p>
    <p><b class="p-volumen">Volumen: </b>
        <?= $volumen ?> Cm3
    </p>
    <p><b class="p-fragil">Fragil: </b>
        <?= $fragil ?>
    </p>
    <?php
    if ($fragil == "Si") {
        echo "<p><b class='p-tipo'>Tipo: </b>$tipo</p>";
    }
    ?>
    <p><b class="p-estado">Estado: </b>
        <?= $estado ?>
    </p>
    <?php
    if (!isset($detalles) || is_null($detalles) || empty(trim($detalles))) {
    } else {
        echo "<p><b class='p-detalles'>Detalles: </b>$detalles</p>";
    }
    ?>


    <a href="op-paquetes.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>

</div>