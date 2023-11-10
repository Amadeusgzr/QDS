<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/recogerPaquetesModelo.php';

$recogerPaquetesModelo = new recogerPaquetesModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        $respuesta = $recogerPaquetesModelo->obtenerRecogerPaquete($_POST->id_camioneta);
        echo json_encode($respuesta);
        break;
    }