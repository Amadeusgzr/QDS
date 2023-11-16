<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/manejaModelo.php';

$manejaModelo = new manejaModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $_GET = json_decode(file_get_contents('php://input', true));

        $respuesta = $manejaModelo->obtenerManeja();

        echo json_encode($respuesta);
        break;
}