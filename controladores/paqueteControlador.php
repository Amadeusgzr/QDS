<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/paqueteModelo.php';

$paqueteModelo = new paqueteModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $_GET = json_decode(file_get_contents('php://input', true));

        $respuesta = $paqueteModelo->obtenerPaquetes();

        echo json_encode($respuesta);
        break;
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        if (isset($_POST->id_paquete)) {
            $respuesta = $paqueteModelo->obtenerPaquete($_POST->id_paquete);
        } else {
            $numArrays = count($_POST->mail_destinatario);
            $mail_destinatario = $_POST->mail_destinatario;
            for ($i = 0; $i < $numArrays; $i++) {
                if (!filter_var($mail_destinatario[$i], FILTER_VALIDATE_EMAIL)) {
                    $respuesta = [
                        'error' => 'Error',
                        'respuesta' => 'La dirección de correo electrónico no es válida'
                    ];
                    break;
                } else {
                    $respuesta = atributoVacio($_POST->mail_destinatario);
                    $respuesta1 = atributoVacio($_POST->direccion);
                    $respuesta2 = atributoVacio($_POST->peso);
                    $respuesta3 = atributoVacio($_POST->volumen);
                    $respuesta4 = atributoVacio($_POST->fragil);
                    if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error" && $respuesta4['error'] !== "Error") {
                        $respuesta = $paqueteModelo->guardarPaquete($_POST->mail_destinatario[$i], $_POST->direccion[$i], $_POST->peso[$i], $_POST->volumen[$i], $_POST->fragil[$i], $_POST->tipo[$i], $_POST->detalles[$i]);
                    } else {
                        $respuesta = [
                            'error' => 'Error',
                            'respuesta' => 'Hay un atributo que no debe estar vacío'
                        ];
                        break;
                    }
                }
            }
        }

        echo json_encode($respuesta);
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input', true));
        $respuesta = atributoVacio($_PUT->id_paquete);
        $respuesta1 = atributoVacio($_PUT->direccion);
        $respuesta2 = atributoVacio($_PUT->peso);
        $respuesta3 = atributoVacio($_PUT->volumen);
        $respuesta4 = atributoVacio($_PUT->fragil);
        $respuesta5 = atributoVacio($_PUT->estado);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error" && $respuesta4['error'] !== "Error" && $respuesta5['error'] !== "Error") {
            $respuesta = $paqueteModelo->modificarPaquete($_PUT->id_paquete, $_PUT->direccion, $_PUT->peso, $_PUT->volumen, $_PUT->fragil, $_PUT->estado);
        } else {
            $respuesta = [
                'error' => 'Error',
                'respuesta' => 'Hay un atributo que no debe estar vacío'
            ];
        }
        echo json_encode($respuesta);
        break;
    case 'DELETE':
        $_DELETE = json_decode(file_get_contents('php://input', true));
        $respuesta = atributoVacio($_DELETE->id_paquete);
        if ($respuesta['error'] !== "Error") {
            $respuesta = $paqueteModelo->eliminarPaquete($_DELETE->id_paquete);
        }
        echo json_encode($respuesta);
        break;
}
function atributoVacio($atributos)
{
    $numArrays = count($atributos);
    for ($i = 0; $i < $numArrays; $i++) {
        foreach ($atributos as $atributo) {
            if (!isset($atributo) || is_null($atributo) || empty(trim($atributo))) {
                $respuesta = [
                    'error' => 'Error',
                    'respuesta' => 'Hay un atributo que no debe estar vacío'
                ];
                break;
            } else {
                $respuesta = [
                    'error' => 'Exito',
                    'respuesta' => 'Todos los atributos están correctos'
                ];
            }
        }
    }
    return $respuesta;
}

?>