<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    if ($_SESSION['tipo_usu'] !== 'camionero') {
        header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
        exit();
    }
}
echo "<link rel='stylesheet' href='../css/estilos.css'>";
require '../plantillas/headerIngresado.php';
require '../plantillas/menu-cuenta.php';

?>

<div id="div-elegir-lote">
    <h1 class="h1-tabla2">Almacenes a recoger</h1>
    <p class="adv">Los siguientes almacenes son por los que tendra que pasar la camioneta</p>
    <?php
    require('../../controladores/api/recoger_paquetesCamionero/obtenerDato.php');
    foreach ($decode as $almacen_cliente) {
    $id_almacen_cliente = $almacen_cliente["id_almacen_cliente"];
    $direccion = $almacen_cliente["direccion"];
    $fecha_recogida_ideal = $almacen_cliente["fecha_recogida_ideal1"];
    $hora_recogida_ideal = $almacen_cliente["hora_recogida_ideal1"];
    echo "<div class='div-almacen-recogida'><hr><p><b class='p1'>Almacen Cliente: </b>Almacen $id_almacen_cliente - $direccion</p>
    <p><b class='p2'>Recogida: </b>$fecha_recogida_ideal $hora_recogida_ideal</p>
    <a href='recoger-paquetes-2.php?id_camioneta=$id_camioneta&id_almacen_cliente=$id_almacen_cliente&fri=$fecha_recogida_ideal&hri=$hora_recogida_ideal'><button class='estilo-boton2 boton-siguiente btn-recoger-paquetes-3'>Ver paquetes del almacén</button></a></div>
    ";
    }
    ?>

    <div id="mov-lote-lote">
        <a href="recoger-paquetes-1.php">
            <button class="boton-volver estilo-boton">Volver</button>
        </a>
    </div>
</div>

</body>

</html>