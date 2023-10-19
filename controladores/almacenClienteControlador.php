<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/almacenClienteModelo.php';
header("Location: ../vistas/permisos.php");


$almacenClienteModelo = new almacenClienteModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        $respuesta = $almacenClienteModelo->obtenerAlmacenClientePorEmpresa($_POST->empresa);

        echo json_encode($respuesta);
        break;
    }
    