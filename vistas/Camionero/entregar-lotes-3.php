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
    require('../../controladores/api/entregar_lotesCamionero/obtenerDato.php');
    foreach ($decode as $plataforma) {
    $id_plataforma = $plataforma["id_plataforma"];
    $direccion = $plataforma["direccion"];
    $ubicacion = $plataforma["departamento_destino"];
    $fecha_entrega_ideal = $plataforma["fecha_entrega_ideal1"];
    $fecha_llegada = $plataforma["fecha_llegada"];
    $fecha_salida = $plataforma["fecha_salida"];
    $almacen_central_salida = $plataforma["almacen_central_salida"];
    $id_camion = $plataforma["id_camion"];

    echo "<div class='div-almacen-recogida'><hr><p><b class='p1'>Almacen Cliente: </b>Almacen $id_plataforma - $direccion</p>
    <p><b class='p2'>Recogida: </b>$fecha_entrega_ideal</p>
    <a href='entregar-lotes-2.php?id_camion=$id_camion&id_plataforma=$id_plataforma&fei=$fecha_entrega_ideal'><button class='estilo-boton2 boton-siguiente btn-recoger-paquetes-3'>Ver paquetes del almacén</button></a></div> 
    ";
    }
    if (!isset($fecha_salida) || is_null($fecha_salida) || empty(trim($fecha_salida))){

    } else{
        echo "<a href='detalles-horarios-entrega.php?id_camion=$id_camion&fs=$fecha_salida&acs=$almacen_central_salida' class='finalizar-recorrido'>Ver detalles</a>"; 
        echo "<a href='../../controladores/api/entregar_lotesCamionero/modificarDato.php?fs=$fecha_salida&ic=$id_camion' class='finalizar-recorrido'>Finalizar recorrido</a>";
    }

    
    ?>

    <div id="mov-lote-lote">
        <a href="entregar-lotes-1.php">
            <button class="boton-volver estilo-boton">Volver</button>
        </a>
    </div>
</div>

</body>

</html>