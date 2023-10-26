<?php
session_start();

if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'empresa') {
    header("Location: ../permisos.php");
    exit();
}

if (!isset($_GET['id_paquete']) || is_null($_GET['id_paquete']) || empty(trim($_GET['id_paquete']))) {
    header("Location: ../error.php");
}

require("../../controladores/api/paquete/obtenerDatoPorId.php");
if(isset($decode['error'])){
    header("Location: ../error.php");
}

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
    $empresa = $paquete["nombre_de_empresa"];
    if ($empresa !== $_SESSION["nom_usu"]){
        header("Location: ../permisos.php");
    }
}

echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>

<div class="form-crud">
    <legend>Consultar Paquete</legend>
    <p class="subtitulo-crud">Datos del paquete</p>
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
    ?>

<?php
if ($estado == "En almacén cliente"){
    echo "<a href='op-paquetes-cliente.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>";
} else if ($estado == "Entregado"){
    echo "<a href='op-paquetes-entregados.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>";
} else {
    echo "<a href='op-paquetes-transcurso.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>";
}
?>
</div>