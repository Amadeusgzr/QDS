<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/loteModelo.php';

$loteModelo = new loteModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $_GET = json_decode(file_get_contents('php://input', true));
        $respuesta = $loteModelo->obtenerLotes();
        echo json_encode($respuesta);
        break;
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        if (isset($_POST->id_lote)) {
            $respuesta = $loteModelo->obtenerLote($_POST->id_lote);
        } else {
            $respuesta = atributoVacio($_POST->mail_destinatario);
            $respuesta1 = atributoVacio($_POST->direccion);
            $respuesta2 = atributoVacio($_POST->peso);
            $respuesta3 = atributoVacio($_POST->volumen);
            $respuesta4 = atributoVacio($_POST->fragil);

            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error" && $respuesta4['error'] !== "Error") {
                $respuesta = $paqueteModelo->guardarPaquete($_POST->mail_destinatario, $_POST->direccion, $_POST->peso, $_POST->volumen, $_POST->fragil, $_POST->tipo, $_POST->detalles);
            } else {
                $respuesta = [
                    'error' => 'Error',
                    'respuesta' => 'Hay un atributo que no debe estar vacío'
                ];
            }
        }
        echo json_encode($respuesta);
        break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input', true));
        $respuesta = atributoVacio($_PUT->id_lote);
        $respuesta1 = atributoVacio($_PUT->cant_paquetes);
        $respuesta2 = atributoVacio($_PUT->peso);
        $respuesta3 = atributoVacio($_PUT->volumen);
        $respuesta4 = atributoVacio($_PUT->fragil);

        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error" && $respuesta4['error'] !== "Error") {
            $respuesta = $loteModelo->modificarLote($_PUT->id_lote, $_PUT->cant_paquetes, $_PUT->peso, $_PUT->volumen, $_PUT->fragil);
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
        $respuesta = atributoVacio($_DELETE->id_lote);
        if ($respuesta['error'] !== "Error") {
            $respuesta = $loteModelo->eliminarLote($_DELETE->id_lote);
        }
        echo json_encode($respuesta);
        break;
}
function atributoVacio($atributo)
{
    if (!isset($atributo) || is_null($atributo) || empty(trim($atributo))) {
        $respuesta = [
            'error' => 'Error',
            'respuesta' => 'Hay un atributo que no debe estar vacío'
        ];
    } else {
        $respuesta = [
            'error' => 'Exito',
            'respuesta' => 'Todos los atributos están correctos'
        ];
    }
    return $respuesta;
}

?>