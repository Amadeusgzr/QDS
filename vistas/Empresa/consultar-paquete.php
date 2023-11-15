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
    $estado = $paquete["paquete_estado"];
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
    <legend class="legend-c-paquete">Consultar Paquete</legend>
    <p><b class='p-id'>ID: </b>
        <?= $id_paquete ?>
    </p>
    <p><b class='p-mail-d'>Mail del destinatario: </b>
        <?= $mail_destinatario ?>
    </p>
    <p><b class='p-direccion'>Dirección: </b>
        <?= $direccion ?>
    </p>
    <p><b class='p-peso'>Peso: </b>
        <?= $peso ?> Kg
    </p>
    <p><b class='p-volumen'>Volumen: </b>
        <?= $volumen ?> Cm3
    </p>
    <p><b class='p-fragil'>Fragil: </b>
        <?= $fragil ?>
    </p>
    <?php
    if(isset($paquete["matricula"])){
        $matricula = $paquete["matricula"];
        echo "    <p><b class='p-matricula'>Matrícula de la camioneta: </b>$matricula</p>";
    }
    ?>

    <?php
    if(isset($paquete["fecha_recogida_ideal"]) && isset($paquete["hora_recogida_ideal"])){
        $fecha_recogida_ideal = $paquete["fecha_recogida_ideal"];
        $hora_recogida_ideal = $paquete["hora_recogida_ideal"];

        echo "<p><b class='p-fecha-traslado'>Fecha y Hora ideal de recogida: </b> $fecha_recogida_ideal - $hora_recogida_ideal </p>";
    }
    ?>
    <?php
    if ($fragil == "Si") {
        echo "<p><b class='p-tipo'>Tipo: </b>$tipo</p>";
    }
    ?>
    <p><b class="p-estado">Estado: </b><?= $estado ?></p>
    <?php
    if (!isset($detalles) || is_null($detalles) || empty(trim($detalles))) {
    } else {
        echo "<p><b class='p-detalles'>Detalles: </b>$detalles</p>";
    }
    ?>

<?php
if ($estado == "En almacén cliente"){
    echo "<a href='op-paquetes-cliente.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
    <script>
    // Agrega un evento de escucha para detectar cuando se presiona una tecla en el teclado
    document.addEventListener('keydown', function(event) {
        if (event.key === 'b' || event.key === 'B') {
            // Redirige a la URL específica
            window.location.href = 'op-paquetes-cliente.php';
        }
    });
    </script>";
} else if ($estado == "Entregado"){
    echo "<a href='op-paquetes-entregados.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
        <script>
    // Agrega un evento de escucha para detectar cuando se presiona una tecla en el teclado
    document.addEventListener('keydown', function(event) {
        if (event.key === 'b' || event.key === 'B') {
            // Redirige a la URL específica
            window.location.href = 'op-paquetes-entregados.php';
        }
    });
    </script>";
} else {
    echo "<a href='op-paquetes-transcurso.php'><input type='submit' value='Volver' class='estilo-boton boton-volver'></a>
    <script>
    // Agrega un evento de escucha para detectar cuando se presiona una tecla en el teclado
    document.addEventListener('keydown', function(event) {
        if (event.key === 'b' || event.key === 'B') {
            // Redirige a la URL específica
            window.location.href = 'op-paquetes-transcurso.php';
        }
    });
    </script>";
}
?>
</div>