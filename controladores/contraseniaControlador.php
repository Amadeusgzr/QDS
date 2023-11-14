<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/contraseniaModelo.php';

$contraseniaModelo = new contraseniaModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input', true));

        $respuesta = $contraseniaModelo->modificarContrasenia($_PUT->contrasenia_actual, $_PUT->contrasenia_cambiar, $_PUT->contrasenia_repetir, $_PUT->usuario);

        echo json_encode($respuesta);
        break;
    }