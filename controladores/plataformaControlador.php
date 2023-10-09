<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/plataformaModelo.php';

$plataformaModelo = new plataformaModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $_GET = json_decode(file_get_contents('php://input', true));

        $respuesta = $plataformaModelo->obtenerPlataformas();

        echo json_encode($respuesta);
        break;
}