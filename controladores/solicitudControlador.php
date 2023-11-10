<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/solicitudModelo.php';

$solicitudModelo = new solicitudModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        $respuesta = $solicitudModelo->obtenerSolicitud($_POST->id_camioneta, $_POST->id_almacen_cliente, $_POST->fecha_recogida_ideal, $_POST->hora_recogida_ideal, $_POST->usuario);
        echo json_encode($respuesta);
        break;
    }