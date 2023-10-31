<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/camionetaModelo.php';

$camionetaModelo = new camionetaModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $_GET = json_decode(file_get_contents('php://input', true));

        $respuesta = $camionetaModelo->obtenerCamionetas();

        echo json_encode($respuesta);
        break;
}