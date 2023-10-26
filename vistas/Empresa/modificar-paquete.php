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
    if ($estado !== "En almacén cliente" || $empresa !== $_SESSION["nom_usu"]){
        header("Location: ../permisos.php");
    }
}

echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

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
        <legend>Modificar Paquete</legend>
        <p class="subtitulo-crud">Datos actuales</p>
        <p><b>ID: </b>
            <?= $id_paquete ?>
        </p>
        <p><b>Dirección: </b>
            <?= $direccion ?>
        </p>
        <p><b>Peso: </b>
            <?= $peso ?>
        </p>
        <p><b>Volumen: </b>
            <?= $volumen ?>
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
        <p class="subtitulo-crud">Datos modificados</p>
        <input type="text" placeholder="ID" class="txt-crud" name="id_paquete" value="<?= $id_paquete ?>" required
            readonly hidden>
        <input type="tel" placeholder="Direccion" class="txt-crud" name="direccion" value="<?= $direccion ?>" required>
        <input type="number" placeholder="Peso" class="txt-crud" name="peso" value="<?= $peso ?>" required>
        <input type="number" placeholder="Volumen" class="txt-crud" name="volumen" value="<?= $volumen ?>" required>
        <input type="text" placeholder="Fragil" class="txt-crud" name="fragil" value="<?= $fragil ?>" required>
        <a href=""><input type="submit" value="Modificar" class="estilo-boton boton-siguiente"></a>
    </form>
    <a href="op-paquetes-cliente.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
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