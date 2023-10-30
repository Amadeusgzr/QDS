<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
include("../../modelos/db.php");
if (isset($_POST["id_almacen_central"])) {
    $id_almacen_central = $_POST["id_almacen_central"];
    $telefono = $_POST["telefono"];
    $numero_almacen = $_POST["numero_almacen"];

    $instruccion = "update almacen_central set numero_almacen='$numero_almacen', telefono='$telefono' where id_almacen_central=$id_almacen_central";
    $conexion->query($instruccion);
    header("Location: modificar-almacen-central.php?id_almacen_central=$id_almacen_central");
} else if (isset($_POST["id_almacen_cliente"])) {
    $id_almacen_cliente = $_POST["id_almacen_cliente"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];

    $instruccion = "update almacen_cliente set direccion='$direccion', telefono='$telefono' where id_almacen_cliente=$id_almacen_cliente";
    $conexion->query($instruccion);
    header("Location: modificar-almacen-cliente.php?id_almacen_cliente=$id_almacen_cliente");

} else if (isset($_POST["id_camion"])) {
    $id_camion = $_POST["id_camion"];
    $matricula = $_POST["matricula"];
    $peso_soportado = $_POST["peso_soportado"];
    $volumen_disponible = $_POST["volumen_disponible"];
    $estado = $_POST["estado"];

    $instruccion1 = "update vehiculo set matricula='$matricula', peso_soportado='$peso_soportado', volumen_disponible='$volumen_disponible', estado='$estado' where id_vehiculo=$id_camion";
    $conexion->query($instruccion1);
    header("Location: modificar-camion.php?id_camion=$id_camion");

} else if (isset($_POST["id_camionero"])) {
    $id_camionero = $_POST["id_camionero"];
    $cedula = $_POST["cedula"];
    $nombre_completo = $_POST["nombre_completo"];
    $mail = $_POST["mail"];
    $telefono = $_POST["telefono"];

    $instruccion1 = "update camionero set cedula='$cedula', nombre_completo='$nombre_completo', mail='$mail', telefono='$telefono' where id_camionero=$id_camionero";
    $conexion->query($instruccion1);
    header("Location: modificar-camionero.php?id_camionero=$id_camionero");

} else if (isset($_POST["id_empresa_cliente"])) {
    $id_empresa = $_POST["id_empresa_cliente"];
    $rut = $_POST["rut"];
    $nombre_de_empresa = $_POST["nombre_de_empresa"];
    $mail = $_POST["mail"];

    $instruccion1 = "update empresa_cliente set rut='$rut', nombre_de_empresa='$nombre_de_empresa', mail='$mail' where id_empresa_cliente=$id_empresa";
    $conexion->query($instruccion1);
    header("Location: modificar-empresa-cliente.php?id_empresa_cliente=$id_empresa");

} else if (isset($_POST["id_plataforma"])) {
    $id_plataforma = $_POST["id_plataforma"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $departamento = $_POST["departamento"];
    $volumen_maximo = $_POST["volumen_maximo"];



    $instruccion1 = "update plataforma set direccion='$direccion', telefono='$telefono', departamento='$departamento', volumen_maximo='$volumen_maximo'  where id_plataforma=$id_plataforma";
    $conexion->query($instruccion1);
    header("Location: modificar-plataforma.php?id_plataforma=$id_plataforma");

} else if (isset($_POST["nom_usu"])) {
    $nom_usu = $_POST["nom_usu"];
    $tipo_usu = $_POST["tipo_usu"];
    $mail = $_POST["mail"];

    $instruccion1 = "update login set nom_usu='$nom_usu', tipo_usu='$tipo_usu', mail='$mail' where nom_usu='$nom_usu'";
    $conexion->query($instruccion1);
    header("Location: modificar-usuario.php?nom_usu=$nom_usu");
} 




?>