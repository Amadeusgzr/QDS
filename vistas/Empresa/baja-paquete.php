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
    if ($estado !== "En almacén cliente" || $empresa !== $_SESSION["nom_usu"]){
        header("Location: ../permisos.php");
    }
}

echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>
<div class="form-crud">
    <legend class="legend-baja-paquete">Eliminar Paquete</legend>

    <p class="adv">¿Seguro que quiere eliminar el siguiente paquete? Los cambios serán irreversibles</p>

    <p><b class="p-id">ID: </b><?= $id_paquete ?></p>

    <p><b class="p-mail-d">Mail del destinatario: </b><?= $mail_destinatario ?></p>
        
    <p><b class="p-direccion">Dirección: </b><?= $direccion ?></p>

    <p><b class="p-peso">Peso: </b><?= $peso ?> kg</p>

    <p><b class="p-volumen">Volumen: </b><?= $volumen ?> cm3</p>

    <p><b class="p-fragil">Frágil: </b><?= $fragil ?></p>

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

    <script>
    // Agrega un evento de escucha para detectar cuando se presiona una tecla en el teclado
    document.addEventListener("keydown", function(event) {
        // Verifica si la tecla presionada es la "R" (puedes usar cualquier otra tecla)
        if (event.key === "d" || event.key === "D") {
            // Redirige a la URL específica
            window.location.href = "../../controladores/api/paquete/eliminarDato.php?id_paquete=<?= $id_paquete ?>";
        }
        if (event.key === "b" || event.key === "B") {
            window.location.href = "op-paquetes-cliente.php";
        }
    });
    </script>

    <a href="../../controladores/api/paquete/eliminarDato.php?id_paquete=<?= $id_paquete ?>"><input type="submit" value="Eliminar" class="estilo-boton boton-siguiente boton-eliminar"></a>
    <a href="op-paquetes-cliente.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>

</div>