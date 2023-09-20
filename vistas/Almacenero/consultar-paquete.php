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
    $direccion = $paquete['direccion'];
    $peso = $paquete["peso"];
    $volumen = $paquete["volumen"];
    $fragil = $paquete["fragil"];
}
?>
<div class="form-crud">
    <legend>Consultar Paquete</legend>
    <p class="subtitulo-crud">Datos del camión</p>
        <p><b>ID: </b><?= $id_paquete?></p>
        <p><b>Dirección: </b><?= $direccion?></p>
        <p><b>Peso: </b><?= $peso?></p>
        <p><b>Volumen: </b><?= $volumen?></p>
        <p><b>Fragil: </b><?= $fragil?></p>


    <a href="op-paquetes.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>