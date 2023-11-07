<?php
if($_GET){
    require ("../../modelos/db.php");
    $id_almacen_cliente = $_GET["id_almacen_cliente"];
    $id_camioneta = $_GET["id_camioneta"];
    $fecha_recogida_ideal = $_GET["fri"];
    $hora_recogida_ideal = $_GET["hri"];

    $instruccion = "SELECT * FROM almacen_cliente INNER JOIN tiene ON almacen_cliente.id_almacen_cliente = tiene.id_almacen_cliente INNER JOIN empresa_cliente ON empresa_cliente.id_empresa_cliente = tiene.id_empresa_cliente WHERE tiene.id_almacen_cliente = $id_almacen_cliente";
    $resultado = mysqli_query($conexion, $instruccion);
    $fila =  mysqli_fetch_assoc($resultado);    
    $empresa = $fila["nombre_de_empresa"];
    session_start();
    $usuario = $_SESSION["nom_usu"];
    echo $usuario;
    $instruccion= "INSERT INTO solicitud (usuario, usuario_destino, detalles, estado, id_almacen_cliente, fecha_recogida_ideal, hora_recogida_ideal) VALUES ('$usuario', '$empresa', 'El camionero $usuario llego a su almacén', 'En espera', '$id_almacen_cliente', '$fecha_recogida_ideal', '$hora_recogida_ideal')";
    mysqli_query($conexion, $instruccion);
    header("Location: recoger-paquetes-2.php?id_camioneta=" . $id_camioneta . "&id_almacen_cliente=" . $id_almacen_cliente . "&fri=" . $fecha_recogida_ideal . "&hri=" . $hora_recogida_ideal);

}
?>