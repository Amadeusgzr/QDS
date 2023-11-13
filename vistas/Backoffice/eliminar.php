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


    $instruccion = "delete from camionero where id_camionero=$id_camionero";
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

    $paquetes = [];
    $instruccion = "select * from almacena where id_almacen_cliente=$id_almacen_cliente";
    $resultado = mysqli_query($conexion, $instruccion);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        array_push($paquetes, $fila);
    }
    
    if (isset($paquetes)){
        if (count($paquetes) > 0) {
           $instruccion = "delete from almacena where id_almacen_cliente=$id_almacen_cliente";
           $conexion->query($instruccion);
        }
    }

    $instruccion = "delete from tiene where id_almacen_cliente=$id_almacen_cliente";
    $conexion->query($instruccion);

    $instruccion = "delete from almacen_cliente where id_almacen_cliente=$id_almacen_cliente";
    $conexion->query($instruccion);
    header("Location: op-almacen-cliente.php");
} else if (isset($_GET['id_almacen_central'])) {
    $id_almacen_central = $_GET['id_almacen_central'];


    $instruccion = "delete from almacen_central where id_almacen_central=$id_almacen_central";
    $conexion->query($instruccion);
    header("Location: op-almacen-central.php");
} else if (isset($_GET['id_plataforma'])) {
    $id_plataforma = $_GET['id_plataforma'];


    $instruccion = "delete from plataforma where id_plataforma=$id_plataforma";
    $conexion->query($instruccion);
    header("Location: op-plataforma.php");
} else if (isset($_GET['id_camion'])) {
    $id_camion = $_GET['id_camion'];


    $instruccion = "delete from camion where id_camion=$id_camion";
    $conexion->query($instruccion);
    $instruccion = "delete from vehiculo where id_vehiculo=$id_camion";
    $conexion->query($instruccion);

    header("Location: op-camiones.php");

} else if (isset($_GET['id_camioneta'])) {
    $id_camioneta = $_GET['id_camioneta'];


    $instruccion = "delete from camioneta where id_camioneta=$id_camioneta";
    $conexion->query($instruccion);

    $instruccion = "delete from vehiculo where id_vehiculo=$id_camioneta";
    $conexion->query($instruccion);

    header("Location: op-camionetas.php");

} else if (isset($_GET['id_trayecto'])) {
    $id_trayecto = $_GET['id_trayecto'];
    $instruccion = "delete from trayecto where id_trayecto=$id_trayecto";
    $conexion->query($instruccion);
    header("Location: op-trayecto.php");
} else if (isset($_GET['id_ruta'])) {
    $id_ruta = $_GET['id_ruta'];


    $instruccion = "delete from ruta where id_ruta=$id_ruta";
    $conexion->query($instruccion);
    header("Location: op-ruta.php");

} else if (isset($_GET['nom_usu'])) {
    $nom_usu = $_GET['nom_usu'];


    $instruccion = "delete from login where nom_usu='$nom_usu'";
    $conexion->query($instruccion);
    header("Location: op-usuarios.php");

} else if (isset($_GET['id_empresa_cliente'])) {

    $id_empresa = $_GET['id_empresa_cliente'];
    
    $instruccion = "select * from tiene where id_empresa_cliente=$id_empresa";
    $resultado = mysqli_query($conexion, $instruccion);
    $fila =  mysqli_fetch_assoc($resultado);
    if (isset($fila)){
        $respuesta = [
            'error' => "Error",
            'respuesta' => "Esta empresa tiene almacenes registrados"
        ];
    } else {
        $instruccion = "delete from empresa_cliente where id_empresa_cliente=$id_empresa";
        $conexion->query($instruccion);
        $respuesta = [
            'error' => "Exito",
            'respuesta' => "Empresa eliminada"
        ];
    }

    $respuesta = json_encode($respuesta);
    header("Location: op-empresas-cliente.php?datos=" . urlencode($respuesta));

} else if (isset($_GET['id_camioneta_horario'])) {
    $id_camioneta_horario = $_GET['id_camioneta_horario'];
    $fecha_salida = $_GET["fs"];
    $almacen_central_salida = $_GET["acs"];

    $instruccion = "delete from recoge where id_camioneta='$id_camioneta_horario' AND fecha_salida='$fecha_salida' AND almacen_central_salida='$almacen_central_salida'";
    $conexion->query($instruccion);
    header("Location: op-gestion-paquete-recogida.php");

} else if (isset($_POST["todo"])){

    $jsonString = $_POST['todo'];
    $camioneros = json_decode($jsonString, true);

    foreach ($camioneros as $camionero){
        $id_camionero = $camionero[0];
        $instruccion = "delete from camionero where id_camionero=$id_camionero";
        $conexion->query($instruccion);
    }
    $respuesta = [
        'error' => "Exito",
        'respuesta' => "Camionero eliminado"
    ];
    $respuesta = json_encode($respuesta);

    $respuesta = urlencode($respuesta);
    echo $respuesta;
}
?>