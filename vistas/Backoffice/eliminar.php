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

    $instruccion = "update camionero set estado='De baja' where id_camionero=$id_camionero";
    $conexion->query($instruccion);

    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Camionero eliminado"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-camioneros.php?datos=" . urlencode($respuesta));
} else if (isset($_GET['id_almacen_cliente'])) {
    $id_almacen_cliente = $_GET['id_almacen_cliente'];

    $instruccion = "update almacen_cliente set estado='De baja' where id_almacen_cliente=$id_almacen_cliente";
    $conexion->query($instruccion);
    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Almacén eliminado"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-almacen-cliente.php?datos=" . urlencode($respuesta));
} else if (isset($_GET['id_almacen_central'])) {
    $id_almacen_central = $_GET['id_almacen_central'];


    $instruccion = "update almacen_central set estado='De baja' where id_almacen_central=$id_almacen_central";
    $conexion->query($instruccion);
    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Almacén eliminado"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-almacen-central.php?datos=" . urlencode($respuesta));
} else if (isset($_GET['id_plataforma'])) {
    $id_plataforma = $_GET['id_plataforma'];


    $instruccion = "update plataforma set estado='De baja' where id_plataforma=$id_plataforma";
    $conexion->query($instruccion);
    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Plataforma eliminada"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-plataforma.php?datos=" . urlencode($respuesta));
} else if (isset($_GET['id_camion'])) {
    $id_camion = $_GET['id_camion'];



    $instruccion = "update vehiculo set estado='De baja' where id_vehiculo=$id_camion";
    $conexion->query($instruccion);

    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Camión eliminado"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-camiones.php?datos=" . urlencode($respuesta));
} else if (isset($_GET['id_camioneta'])) {
    $id_camioneta = $_GET['id_camioneta'];

    $instruccion = "update vehiculo set estado='De baja' where id_vehiculo=$id_camioneta";
    $conexion->query($instruccion);

    header("Location: op-camionetas.php");
} else if (isset($_GET['id_ruta'])) {
    $id_ruta = $_GET['id_ruta'];


    $instruccion = "delete from ruta where id_ruta=$id_ruta";
    $conexion->query($instruccion);
    header("Location: op-ruta.php");

} else if (isset($_GET['id_empresa_cliente'])) {

    $id_empresa = $_GET['id_empresa_cliente'];

    $instruccion = "update empresa_cliente set estado='De baja' where id_empresa_cliente=$id_empresa";
    $conexion->query($instruccion);
    
    $almacenes_cliente = [];
    $instruccion = "select * from tiene where id_empresa_cliente=$id_empresa";
    $resultado = mysqli_query($conexion, $instruccion);
    while ($row = mysqli_fetch_assoc($resultado)) {
        array_push($almacenes_cliente, $row);
    }
    foreach ($almacenes_cliente as $almacen_cliente){
        $id_almacen_cliente = $almacen_cliente["id_almacen_cliente"];
        $instruccion = "update almacen_cliente set estado='De baja' where id_almacen_cliente=$id_almacen_cliente";
        $conexion->query($instruccion);
    }

    $respuesta = [
        'error' => "Éxito",
        'respuesta' => "Empresa eliminada"
    ];
    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-empresas-cliente.php?datos=" . urlencode($respuesta));

} else if (isset($_GET['icth'])) {
    $id_camioneta_horario = $_GET['icth'];
    $fecha_salida = $_GET["fs"];
    $almacen_central_salida = $_GET["acs"];
    date_default_timezone_set('America/Montevideo');

    
    $fecha_hora_actual = time();
    $fecha_salida1 = strtotime($fecha_salida);
   

    if ($fecha_salida1 > $fecha_hora_actual){
        $instruccion = "delete from recoge where id_camioneta='$id_camioneta_horario' AND fecha_salida='$fecha_salida' AND almacen_central_salida='$almacen_central_salida'";
        $conexion->query($instruccion);
        $respuesta = [
            'error' => "Éxito",
            'respuesta' => "Horario eliminado"
        ];
    } else {
        $respuesta = [
            'error' => "Error",
            'respuesta' => "No se puede eliminar un horario que ya pasó"
        ];
    }

    $conexion->close();
    $respuesta = json_encode($respuesta);
    header("Location: op-gestion-paquete-recogida.php?datos=" . urlencode($respuesta));

} else if (isset($_GET['id_camion_horario'])) {
    $id_camion_horario = $_GET['id_camion_horario'];
    $fecha_salida = $_GET["fs"];
    $almacen_central_salida = $_GET["acs"];

    $instruccion = "delete from lleva where id_camion='$id_camion_horario' AND fecha_salida='$fecha_salida' AND almacen_central_salida='$almacen_central_salida'";
    $conexion->query($instruccion);
    header("Location: op-gestion-lote-entrega.php");
    
} else if (isset($_GET['id_maneja'])) {
        $id_maneja = $_GET['id_maneja'];
    
        $instruccion = "delete from maneja where id_maneja=$id_maneja";
        $conexion->query($instruccion);
        header("Location: op-camionero-vehiculo.php");

} else if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];

    $instruccion = "delete from login where id_usuario=$id_usuario";
    $conexion->query($instruccion);
    header("Location: op-usuarios.php");

} else if (isset($_POST["todo"])){
    
    $jsonString = $_POST['todo'];
    $camioneros = json_decode($jsonString, true);

    foreach ($camioneros as $camionero){
        $id_camionero = $camionero[0];

        $instruccion = "update camionero set estado='De baja' where id_camionero=$id_camionero";
        $conexion->query($instruccion);

    }

    if (count($camioneros) == 1){
        $respuesta = [
            'error' => "Éxito",
            'respuesta' => "Camionero eliminado"
            ];  
    } else if (count($camioneros) > 1){
        $respuesta = [
            'error' => "Éxito",
            'respuesta' => "Camioneros eliminados"
        ];  
    } else {
        $respuesta = [
            'error' => "Éxito",
            'respuesta' => "No se ha seleccionado ninguna fila"
        ]; 
    }

    $respuesta = json_encode($respuesta);

    $respuesta = urlencode($respuesta);
    echo $respuesta;
}
?>