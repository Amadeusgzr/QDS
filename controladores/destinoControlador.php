<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/destinoModelo.php';

$destinoModelo = new destinoModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $_GET = json_decode(file_get_contents('php://input', true));

        $respuesta = $destinoModelo->obtenerDestinos();

        echo json_encode($respuesta);
        break;
}