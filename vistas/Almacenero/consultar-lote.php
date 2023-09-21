<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'almacenero') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
        exit();
    }
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
    <legend>Consultar Lote</legend>
    <p class="subtitulo-crud">Datos del lote</p>
        <p><b>ID: </b><?= " "?></p>
        <p><b>Dirección: </b><?= " "?></p>
        <p><b>Peso: </b><?= " "?> Kg</p>
        <p><b>Volumen: </b><?= " "?> Cm3</p>
        <p><b>Fragil: </b><?= " "?></p>
        <p><b>Estado: </b><?= " "?></p>


    <a href="op-lotes.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>