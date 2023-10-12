<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/paqueteLoteModelo.php';

$paqueteLoteModelo = new paqueteLoteModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        if (isset($_POST->id_lote1)) {
            $respuesta = $paqueteLoteModelo->obtenerLotePorId($_POST->id_lote1);
        } else {
            $respuesta = atributoVacio($_POST->id_paquete);
            $respuesta1 = atributoVacio($_POST->id_lote);

            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error") {
                $respuesta = $paqueteLoteModelo->guardarPaqueteLote($_POST->id_paquete, $_POST->id_lote);
            } else {
                $id_lote = $_POST->id_lote;

                $respuesta = [
                    'error' => 'Error',
                    'respuesta' => 'Hay un atributo que no debe estar vacío',
                ];

            }
        }


        echo json_encode($respuesta);
        break;
    case 'DELETE':
        $_DELETE = json_decode(file_get_contents('php://input', true));
        $respuesta = atributoVacio($_DELETE->id_paquete);
        $respuesta1 = atributoVacio($_DELETE->id_lote);
        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error") {
            $respuesta = $paqueteLoteModelo->eliminarPaqueteLote($_DELETE->id_paquete, $_DELETE->id_lote);
        } else {
            $id_lote = $_DELETE->id_lote;

            $respuesta = [
                'error' => 'Error',
                'respuesta' => 'Hay un atributo que no debe estar vacío',
            ];

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