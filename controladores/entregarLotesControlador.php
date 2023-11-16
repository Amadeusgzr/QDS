<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/entregarLotesModelo.php';

$entregarLotesModelo = new entregarLotesModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        $respuesta = $entregarLotesModelo->obtenerRecogerPaquete($_POST->id_camion);
        echo json_encode($respuesta);
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input', true));
        if(isset($_PUT->id_camion)) {
            $respuesta = $entregarLotesModelo->modificarFecha($_PUT->id_camion, $_PUT->fecha_salida);
        }
        echo json_encode($respuesta);
        break;
    }