<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/paqueteModelo.php';

$paqueteModelo = new paqueteModelo();
switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        $respuesta = $paqueteModelo->obtenerPaquetes();
        echo json_encode($respuesta);
    break;
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        $respuesta = atributoVacio($_POST->mail_destinatario);
        if($respuesta['error'] !== "Error"){
            $respuesta = $paqueteModelo->guardarPaquete($_POST->mail_destinatario, $_POST->direccion, $_POST->peso, $_POST->volumen, $_POST->fragil, $_POST->tipo, $_POST->detalles);
        }
        echo json_encode($respuesta);
    break;
    case'PUT':
        $_PUT = json_decode(file_get_contents('php://input', true));
        if(!isset($_PUT->id) || is_null($_PUT->id) || empty(trim($_PUT->id))){
            $response = ['Error', 'El ID del paquete no debe estar vacío'];
        } 
        else if(!isset($_PUT->name) || is_null($_PUT->name) || empty(trim($_PUT->name))){
            $response = ['Error', 'El nombre del paquete no debe estar vacío'];
        } 
        else if (!isset($_PUT->description) || is_null($_PUT->description) || empty(trim($_PUT->description))){
            $response = ['Error', 'La descripción del paquete no debe estar vacía'];
        }
        else if(strlen($_PUT->name) > 50){
            $response = ['Error','El nombre del paquete no puede ser mayor a 50 caracteres'];
        }
        else if(strlen($_PUT->description) > 50){
            $response = ['Error','La descripción del paquete no puede ser mayor a 50 caracteres'];
        }
        else if (!is_numeric($_PUT->id)){
            $response = ['Error','El ID del paquete debe ser numérico'];
        }
        else{
            $response = $packageModel->updatePackage($_PUT->id, $_PUT->name, $_PUT->description);
        }
        echo json_encode($response);
    break;
    case 'DELETE':
        $_DELETE = json_decode(file_get_contents('php://input', true));
        if(!isset($_DELETE->id) || is_null($_DELETE->id) || empty(trim($_DELETE->id))){
            $response = ['Error', 'El ID del paquete no debe estar vacío'];
        } 
        else{
            $response = $packageModel->deletePackage($_DELETE->id);
        }
        echo json_encode($response);
    break;
}
function atributoVacio($atributo){
    if(!isset($atributo) || is_null($atributo) || empty(trim($atributo))){
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