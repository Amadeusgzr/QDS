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
    $id_camioneta = $_GET["id_camioneta"];
    require ("../../modelos/db.php");
    $almacenes_cliente = [];
    $instruccion = "SELECT *, recoge.fecha_recogida_ideal AS fecha_recogida_ideal1, recoge.hora_recogida_ideal AS hora_recogida_ideal1 FROM recoge JOIN ( SELECT * FROM recoge WHERE recoge.fecha_recogida IS NULL AND recoge.hora_recogida IS NULL AND recoge.id_camioneta = '$id_camioneta' ORDER BY ABS(TIMESTAMPDIFF(SECOND, CONCAT(fecha_salida, ' ', hora_salida), NOW())) ASC LIMIT 1 ) closest ON recoge.id_camioneta = closest.id_camioneta AND recoge.fecha_salida = closest.fecha_salida AND recoge.hora_salida = closest.hora_salida INNER JOIN almacen_cliente ON recoge.id_almacen_cliente = almacen_cliente.id_almacen_cliente";
    $resultado = mysqli_query($conexion, $instruccion);
    while ($row = mysqli_fetch_assoc($resultado)) {
    array_push($almacenes_cliente, $row);
    }
    foreach ($almacenes_cliente as $almacen_cliente) {
    $id_almacen_cliente = $almacen_cliente["id_almacen_cliente"];
    $direccion = $almacen_cliente["direccion"];
    $fecha_recogida_ideal = $almacen_cliente["fecha_recogida_ideal1"];
    $hora_recogida_ideal = $almacen_cliente["hora_recogida_ideal1"];
    echo "<p><b>Almacen Cliente: </b>Almacen $id_almacen_cliente - $direccion</p>
    <p><b>Recogida: </b>$fecha_recogida_ideal $hora_recogida_ideal</p>
    ";
    echo "<a href='recoger-paquetes-2.php?id_camioneta=$id_camioneta&id_almacen_cliente=$id_almacen_cliente&fri=$fecha_recogida_ideal&hri=$hora_recogida_ideal'><button>Ver paquetes del almacén</button></a>";
    echo "<hr>";
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