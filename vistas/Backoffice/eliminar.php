<?php
session_start();

// Verifica si el usuario ha iniciado sesión y tiene permisos para acceder a esta página
if (!isset($_SESSION['nom_usu']) || $_SESSION['tipo_usu'] !== 'admin') {
    header("Location: ../permisos.php"); // Redirige a la página de inicio de sesión
    exit();
}
include("../../modelos/db.php");
if(isset($_GET['id_camionero'])){
        $id_camionero = $_GET['id_camionero'];


        $instruccion = "delete from camionero where id_camionero=$id_camionero";
        $conexion->query($instruccion);
        header("Location: op-camioneros.php");
    } else if (isset($_GET['id_almacen_cliente'])){
        $id_almacen_cliente = $_GET['id_almacen_cliente'];


        $instruccion = "delete from almacen_cliente where id_almacen_cliente=$id_almacen_cliente";
        $conexion->query($instruccion);
        header("Location: op-almacen-cliente.php");
    }else if (isset($_GET['id_almacen_central'])){
        $id_almacen_central = $_GET['id_almacen_central'];


        $instruccion = "delete from almacen_central where id_almacen_central=$id_almacen_central";
        $conexion->query($instruccion);
        header("Location: op-almacen-central.php");
    }else if (isset($_GET['id_plataforma'])){
        $id_plataforma = $_GET['id_plataforma'];


        $instruccion = "delete from plataforma where id_plataforma=$id_plataforma";
        $conexion->query($instruccion);
        header("Location: op-plataforma.php");
    }else if (isset($_GET['id_camion'])){
        $id_camion = $_GET['id_camion'];


        $instruccion = "delete from camion where id_camion=$id_camion";
        $conexion->query($instruccion);
        header("Location: op-camiones.php");
    }
    

?>