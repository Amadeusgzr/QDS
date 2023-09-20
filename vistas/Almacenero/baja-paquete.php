<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
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
    $estado = $paquete["estado"];
}
?>
<div class="form-crud">
        <legend>Eliminar Paquete</legend>
        <p class="adv">¿Seguro que quiere eliminar el siguiente paquete? Los cambios serán irreversibles</p>
        <p><b>ID: </b><?= $id_paquete?></p>
        <p><b>Dirección: </b><?= $direccion?></p>
        <p><b>Peso: </b><?= $peso?> kg</p>
        <p><b>Volumen: </b><?= $volumen?> cm3</p>
        <p><b>Frágil: </b><?= $fragil?></p>
        <p><b>Estado: </b><?= $estado?></p>
        <a href="../../controladores/api/paquete/eliminarDato.php?id_paquete=<?= $id_paquete?>"><input type="submit" value="Eliminar" class="estilo-boton boton-siguiente"></a>
    <a href="op-paquetes.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
    <?php
                if (isset($_GET['data'])) {
                    $jsonData = urldecode($_GET['data']);
                    $data = json_decode($jsonData, true);
                    echo $data['error'] . " ";
                    echo $data['respuesta'];
                }
?>
</div>
