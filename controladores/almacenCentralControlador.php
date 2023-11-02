<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/almacenCentralModelo.php';

$almacenCentralModelo = new almacenCentralModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $_GET = json_decode(file_get_contents('php://input', true));

        $respuesta = $almacenCentralModelo->obtenerAlmacenesCentrales();

        echo json_encode($respuesta);
        break;
}