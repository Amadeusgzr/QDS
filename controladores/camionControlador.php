<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/camionModelo.php';

$camionModelo = new camionModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $_GET = json_decode(file_get_contents('php://input', true));

        $respuesta = $camionModelo->obtenerCamiones();

        echo json_encode($respuesta);
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input', true));
        if (isset($_PUT->id_camion)) {
            $respuesta = $camionModelo->modificarEstado($_PUT->id_camion);
        }
        echo json_encode($respuesta);
        break;
}