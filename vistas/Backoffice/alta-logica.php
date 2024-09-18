<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
include("../../modelos/db.php");
if (isset($_GET['id_camionero'])) {
    $id_camionero = $_GET['id_camionero'];

    $instruccion = "update camionero set estado='Disponible' where id_camionero=$id_camionero";
    $conexion->query($instruccion);

    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Camionero agregado"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-camioneros-baja.php?datos=" . urlencode($respuesta));
} else if (isset($_GET['id_camion'])) {
    $id_camion = $_GET['id_camion'];

    $instruccion = "update vehiculo set estado='Disponible' where id_vehiculo=$id_camion";
    $conexion->query($instruccion);

    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Camión agregado"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-camiones-baja.php?datos=" . urlencode($respuesta));
}  else if (isset($_GET['id_camioneta'])) {
    $id_camioneta = $_GET['id_camioneta'];

    $instruccion = "update vehiculo set estado='Disponible' where id_vehiculo=$id_camioneta";
    $conexion->query($instruccion);

    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Camioneta agregada"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-camionetas-baja.php?datos=" . urlencode($respuesta));
}  else if (isset($_GET['id_almacen_central'])) {
    $id_almacen_central = $_GET['id_almacen_central'];


    $instruccion = "update almacen_central set estado='En uso' where id_almacen_central=$id_almacen_central";
    $conexion->query($instruccion);
    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Almacén agregado"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-almacen-central-baja.php?datos=" . urlencode($respuesta));
} else if (isset($_GET['id_almacen_cliente'])) {
    $id_almacen_cliente = $_GET['id_almacen_cliente'];

    $instruccion = "update almacen_cliente set estado='En uso' where id_almacen_cliente=$id_almacen_cliente";
    $conexion->query($instruccion);
    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Almacén agregado"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-almacen-cliente-baja.php?datos=" . urlencode($respuesta));
}  else if (isset($_GET['id_plataforma'])) {
    $id_plataforma = $_GET['id_plataforma'];


    $instruccion = "update plataforma set estado='En uso' where id_plataforma=$id_plataforma";
    $conexion->query($instruccion);
    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Plataforma agregada"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-plataforma-baja.php?datos=" . urlencode($respuesta));
} else if (isset($_GET['id_empresa_cliente'])) {

    $id_empresa = $_GET['id_empresa_cliente'];

    $instruccion = "update empresa_cliente set estado='Disponible' where id_empresa_cliente=$id_empresa";
    $conexion->query($instruccion);
    
    $almacenes_cliente = [];
    $instruccion = "select * from tiene where id_empresa_cliente=$id_empresa";
    $resultado = mysqli_query($conexion, $instruccion);
    while ($row = mysqli_fetch_assoc($resultado)) {
        array_push($almacenes_cliente, $row);
    }
    foreach ($almacenes_cliente as $almacen_cliente){
        $id_almacen_cliente = $almacen_cliente["id_almacen_cliente"];
        $instruccion = "update almacen_cliente set estado='En uso' where id_almacen_cliente=$id_almacen_cliente";
        $conexion->query($instruccion);
    }

    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Empresa agregada"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-empresas-cliente-baja.php?datos=" . urlencode($respuesta));

}