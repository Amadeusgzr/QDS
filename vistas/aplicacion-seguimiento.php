<?php

require 'plantillas/headerInvitado.php';

?>

<?php
if ($_GET){
    require("../controladores/api/paquete/obtenerDatoPorCodigo.php");

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
    <legend>Datos del paquete</legend>
    <p><b>ID: </b>
        <?= $id_paquete ?>
    </p>
    <p><b>Mail del destinatario: </b>
        <?= $mail_destinatario ?>
    </p>
    <p><b>Dirección: </b>
        <?= $direccion ?>
    </p>
    <p><b>Peso: </b>
        <?= $peso ?> Kg
    </p>
    <p><b>Volumen: </b>
        <?= $volumen ?> Cm3
    </p>
    <p><b>Fragil: </b>
        <?= $fragil ?>
    </p>
    <?php
    if ($fragil == "Si") {
        echo "<p><b>Tipo: </b>$tipo</p>";
    }
    ?>
    <p><b>Estado: </b>
        <?= $estado ?>
    </p>
    <?php
    if (!isset($detalles) || is_null($detalles) || empty(trim($detalles))) {
    } else {
        echo "<p><b>Detalles: </b>$detalles</p>";
    }
}
    ?>



<script src="../js/aplicacion-camionero.js"></script>

</body>

</html>