<?php
header('content-type: application/json; charset=utf-8');
require '../modelos/loteCamionModelo.php';

$loteCamionModelo = new loteCamionModelo();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input', true));
        if (isset($_POST->id_camion1)) {
            $respuesta = $loteCamionModelo->obtenerCamionPorId($_POST->id_camion1);
        } else {
            $respuesta = atributoVacio($_POST->id_lote);
            $respuesta1 = atributoVacio($_POST->id_camion);

            if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error") {
                $respuesta = $loteCamionModelo->guardarLoteCamion($_POST->id_lote, $_POST->id_camion);
            } else {
                $id_camion = $_POST->id_camion;

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
        $respuesta = atributoVacio($_DELETE->id_camion);
        $respuesta1 = atributoVacio($_DELETE->id_lote);
        if ($respuesta['error'] !== "Error" && $respuesta1['error'] !== "Error") {
            $respuesta = $loteCamionModelo->eliminarPaqueteLote($_DELETE->id_camion, $_DELETE->id_lote);
        } else {
            $id_camion = $_DELETE->id_camion;

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