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
    <legend>Consultar Paquete</legend>
    <p class="subtitulo-crud">Datos del paquete</p>
        <p><b>ID: </b><?= $id_paquete?></p>
        <p><b>Mail del destinatario: </b><?= $mail_destinatario?></p>
        <p><b>Dirección: </b><?= $direccion?></p>
        <p><b>Peso: </b><?= $peso?> Kg</p>
        <p><b>Volumen: </b><?= $volumen?> Cm3</p>
        <p><b>Fragil: </b><?= $fragil?></p>
        <?php
            if($fragil == "Si"){
                echo "<p><b>Tipo: </b>$tipo</p>";
            }
        ?>
        <p><b>Estado: </b><?= $estado?></p>
        <?php
            if (!isset($detalles) || is_null($detalles) || empty(trim($detalles))) {
            }else{
                echo "<p><b>Detalles: </b>$detalles</p>";
            }
        ?>
        

    <a href="op-paquetes.php"><input type="submit" value="Volver" class="estilo-boton boton-volver"></a>
</div>