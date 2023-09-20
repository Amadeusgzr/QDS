<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/paqueteModelo.php';

$paqueteModelo = new paqueteModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $_GET = json_decode(file_get_contents('php://input', true));

        if (isset($_GET->id_paquete)) {
            $id_paquete = $_GET->id_paquete;
            $respuesta = $paqueteModelo->obtenerPaquete($id_paquete);
        } else {
            $respuesta = $paqueteModelo->obtenerPaquetes();
        }
        echo json_encode($respuesta);
        break;
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        if (isset($_POST->id_paquete)) {
            $respuesta = $paqueteModelo->obtenerPaquete($_POST->id_paquete);
        } else {
            $respuesta = atributoVacio($_POST->mail_destinatario);
            $respuesta1 = atributoVacio($_POST->direccion);
            $respuesta2 = atributoVacio($_POST->peso);
            $respuesta3 = atributoVacio($_POST->volumen);
            $respuesta4 = atributoVacio($_POST->fragil);

            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error" && $respuesta2['error'] !== "Error" && $respuesta3['error'] !== "Error" && $respuesta4['error'] !== "Error") {
                $respuesta = $paqueteModelo->guardarPaquete($_POST->mail_destinatario, $_POST->direccion, $_POST->peso, $_POST->volumen, $_POST->fragil, $_POST->tipo, $_POST->detalles);
            } else{
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
        if (!isset($_PUT->id) || is_null($_PUT->id) || empty(trim($_PUT->id))) {
            $response = ['Error', 'El ID del paquete no debe estar vacío'];
        } else if (!isset($_PUT->name) || is_null($_PUT->name) || empty(trim($_PUT->name))) {
            $response = ['Error', 'El nombre del paquete no debe estar vacío'];
        } else if (!isset($_PUT->description) || is_null($_PUT->description) || empty(trim($_PUT->description))) {
            $response = ['Error', 'La descripción del paquete no debe estar vacía'];
        } else if (strlen($_PUT->name) > 50) {
            $response = ['Error', 'El nombre del paquete no puede ser mayor a 50 caracteres'];
        } else if (strlen($_PUT->description) > 50) {
            $response = ['Error', 'La descripción del paquete no puede ser mayor a 50 caracteres'];
        } else if (!is_numeric($_PUT->id)) {
            $response = ['Error', 'El ID del paquete debe ser numérico'];
        } else {
            $response = $packageModel->updatePackage($_PUT->id, $_PUT->name, $_PUT->description);
        }
        echo json_encode($response);
        break;
    case 'DELETE':
        $_DELETE = json_decode(file_get_contents('php://input', true));
        $respuesta = atributoVacio($_DELETE->id_paquete);
        if ($respuesta['error'] !== "Error"){
            $respuesta = $paqueteModelo->eliminarPaquete($_DELETE->id_paquete);
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