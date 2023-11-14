<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/mensajeModelo.php';

$mensajeModelo = new mensajeModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));

        if (filter_var($_POST->mail_remitente, FILTER_VALIDATE_EMAIL)) {
            if (preg_match('/^[a-zA-Z\s]+$/', $_POST->nombre_remitente)) {
                $respuesta = $mensajeModelo->guardarMensaje($_POST->nombre_remitente, $_POST->mail_remitente, $_POST->mensaje, $_POST->fecha_mensaje);
            } else {
                $respuesta = [
                    'error' => 'Error',
                    'respuesta' => "El nombre debe de tener solo letras"
                ];            
            }
        } else {
            $respuesta = [
                'error' => 'Error',
                'respuesta' => "La dirección de correo electrónico no es válida"
            ];
        }

        echo json_encode($respuesta);
        break;
}